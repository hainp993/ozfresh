const { Button, Table, Popconfirm, message, Input, Space ,Select  } = require("antd");
import { DeleteFilled, EditFilled, CopyOutlined } from "@ant-design/icons";
import Breadcrumb from "../../components/breadcrumbs";
import { useNavigate , useParams} from "react-router";
import { useQueryClient, useQuery } from "react-query";
import { Link, useLocation } from "react-router-dom";
import { css } from "@emotion/react";
import React, { useEffect, useState } from "react";
import { useDebounce } from "../../../lib/hook";
import moment from "moment";
import Calendar from "../../components/calendar";
import { values } from "lodash";


const OrderProduct = () => {
    const location = useLocation();
    const navigate = useNavigate();
    const queryClient = useQueryClient();
    const [search, setSearch] = useState(null);
    const [startDate, setStartDate] = useState();
    const [valueSelect, setvalueSelect] = useState(0);
    const [endDate, setEndDate] = useState();
    const [data, setData] = useState([]);
    const [isloading, setIsLoading] = useState(false)
    const { Option } = Select;
    const { id } = useParams();
    const debouncedSearchQuery = useDebounce(search, 600);

    const [pagination, setPagination] = useState({
        current: 1,
        pageSize: 5,
        total: 0,
    });
    
    useEffect(async () => {
        setIsLoading(true)
        const { data } = await axios.get("/api/admin/order", {
            params: {
                page: pagination.current,
                pageSize: pagination.pageSize,
                search: debouncedSearchQuery,
                start_date: startDate
                ? moment(startDate, "DD-MM-YYYY").format("YYYY-MM-DD")
                : null,
               end_date: endDate
                ? moment(endDate, "DD-MM-YYYY").format("YYYY-MM-DD")
                : null,
            },
        });
        setPagination({
            ...pagination,
            total: data.total,
        });
        setData(data.data);
        setIsLoading(false)
    }, [pagination.current, debouncedSearchQuery, startDate, endDate]);

    const handleTableChange = (pagination, filters, sorter) => {
        setPagination(pagination);
    };
    const handleChange = async (id , status) => {
        setvalueSelect(status)
        try {
            await axios.put("/api/admin/order/" + id, {status:status});
            message.success("S???a th??? lo???i th??nh c??ng");
        } catch ({ response }) {
            const { data } = response;
            message.error(data.message);
        }
    };

    const handleDelete = async (id) => {
        try {
            await axios.delete("/api/admin/order/" + id);
            const newData = data.filter(item => item.id !== id);
            setData(newData);
            message.success("Xo?? th??? lo???i th??nh c??ng");
            queryClient.invalidateQueries("order");
        } catch ({ response }) {
            const { data } = response;
            message.error(data.error);
        }
    };

    return (
        <div>
            <Breadcrumb items={["th??? lo???i s??ch"]}>
                <Space>
                    {/* <Button
                        onClick={() => navigate("/admin/order/new")}
                        className="ml-auto"
                        type="primary"
                    >
                        Order s??ch
                    </Button> */}
                    <Input
                        placeholder="T??m ki???m"
                        value={search}
                        onChange={(e) => setSearch(e.target.value)}
                    />
                    <Calendar
                        name = "startDate"
                        onChange={(date) => setStartDate(date)}
                        placeholder="Start date"
                    />
                    <Calendar
                        name = "endDate"
                        onChange={(date) => setEndDate(date)}
                        placeholder="End date"
                    />
                </Space>
            </Breadcrumb>
            <div
                className="site-layout-background"
                style={{ padding: 24, minHeight: 360 }}
            >
                <Table
                    footer={() => `T???ng s??? s??ch ${pagination.total}`}
                    rowKey={(record) => record.id}
                    pagination={pagination}
                    onChange={handleTableChange}
                    columns={[
                        {
                            title: "STT",
                            render: (text, record, index) => index + 1,
                        },
                        {
                            title: "T??n",
                            dataIndex: "fullName",
                        },
                        {
                            title: "S??t",
                            dataIndex: "phone",
                        },
                        {
                            title: "Email",
                            dataIndex: "email",
                        },
                        {
                            title: "?????a ch???",
                            dataIndex: "ship_address",
                        },
                        {
                            title: "Th??nh ti???n",
                            dataIndex: "total",
                        },
                        
                        {
                            title: "Tr???ng th??i",
                            dataIndex: "status",
                            key: "status",
                            className: "text-center",
                            render: (text, record) => (
                              <>
                        
                                    <Select
                                    labelInValue
                                    defaultValue={{ value: 'Ch??a thanh to??n' }}
                                    style={{ width: 150 }}
                                    // value={valueSelect}
                                    // onChange={() => handleChange(record.id, valueSelect)}
                                  >
                                    <Option className="badge bg-primary" value="0">Ch??a x??? l??</Option>
                                    <Option lassName="badge bg-warning " value="1" selected>???? thanh to??n</Option>
                                    <Option lassName="badge bg-warning " value="2">H???y</Option>
                                  </Select>
                              </>
                            ),
                          },
                        {
                            title: "Ng??y t???o",
                            render: (text, record, index) => {
                                return (
                                    <span>
                                        {moment(record.created_at).format(
                                            "DD/MM/YYYY, hh:mm"
                                        )}
                                    </span>
                                );
                            },
                        },
                        {
                            width: 100,
                            render: (text, record, index) => {
                                return (
                                    <div key={index}>
                                        <Link
                                            className="mr-2"
                                            to={`/admin/order/${record.id}`}
                                        >
                                            <EditFilled />
                                        </Link>
                                        <Popconfirm
                                            title="X??c nh???n xo??"
                                            onConfirm={() =>
                                                handleDelete(record.id)
                                            }
                                        >
                                            <DeleteFilled
                                                css={css`
                                                    color: red;
                                                `}
                                            />
                                        </Popconfirm>
                                    </div>
                                );
                            },
                        },
                    ]}
                    dataSource={data}
                    isloading={isloading}
                />
            </div>
        </div>
    );
};
export default OrderProduct;
