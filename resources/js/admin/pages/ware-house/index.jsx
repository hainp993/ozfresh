const {
    Button,
    Table,
    Popconfirm,
    message,
    Input,
    Space,
    Switch,
} = require("antd");
import { DeleteFilled, EditFilled } from "@ant-design/icons";
import Breadcrumb from "../../components/breadcrumbs";
import { useNavigate } from "react-router";
import { useQueryClient } from "react-query";
import { Link, useLocation } from "react-router-dom";
import { css } from "@emotion/react";
import { useEffect, useState } from "react";
import { useDebounce } from "../../../lib/hook";
import moment from "moment";
import Calendar from "../../components/calendar";

const WareHousePage = () => {
    const location = useLocation();
    const navigate = useNavigate();
    const queryClient = useQueryClient();
    const [search, setSearch] = useState(null);
    const [startDate, setStartDate] = useState();
    const [endDate, setEndDate] = useState();
    const [data, setData] = useState([]);
    const [isloading, setIsLoading] = useState(false);

    const debouncedSearchQuery = useDebounce(search, 600);

    const [pagination, setPagination] = useState({
        current: 1,
        pageSize: 5,
        total: 0,
    });


    useEffect(async () => {
        setIsLoading(true);
        const { data } = await axios.get("/api/admin/ware-house/bill", {
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

        console.log(data.data,'data.data');
        setData(data.data);
        setIsLoading(false);
    }, [pagination.current, debouncedSearchQuery, startDate, endDate]);

    const handleTableChange = (pagination, filters, sorter) => {
        setPagination(pagination);
    };

    const handleDelete = async (id) => {
        try {
            await axios.delete("/api/admin/ware-house/bill/" + id);
            const newData = data.filter((item) => item.id !== id);
            setData(newData);
            message.success("Xoá tin tức thành công");
            queryClient.invalidateQueries("ware-house");
        } catch ({ response }) {
            const { data } = response;
            message.error(data.error);
        }
    };

    const onChange = async (record) => {
        await axios.put("/api/admin/ware-house/bill/"  + record.id, {
            ...record,
            status: !record.status,
        });
    };

    return (
        <div>
            <Breadcrumb items={["Tồn kho"]}>
                <Space>
                    <Button
                            onClick={() => navigate("/admin/products/ware-house/new")}
                            className="ml-auto"
                            type="primary"
                        >
                        Thêm phiếu nhập
                    </Button>
                    <Input
                        placeholder="Tìm kiếm"
                        value={search}
                        onChange={(e) => setSearch(e.target.value)}
                    />
                    <Calendar
                        name="startDate"
                        onChange={(date) => setStartDate(date)}
                        placeholder="Start date"
                    />
                    <Calendar
                        name="endDate"
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
                    footer={() => `Tổng số sách ${pagination.total}`}
                    rowKey={(record) => record.id}
                    pagination={pagination}
                    onChange={handleTableChange}
                    columns={[
                        {
                            title: "STT",
                            render: (text, record, index) => index + 1,
                        },
                        {
                            title: "Ngày nhập",
                            render: (text, record, index) => {
                                return (
                                    <span>
                                        {moment(record.date).format(
                                            "DD/MM/YYYY"
                                        )}
                                    </span>
                                );
                            },

                        },
                        {
                            title: "Ghi chú",
                            render: (text, record) => {
                                return (
                                    <span>
                                       {record.note?.length > 20 ? record.note?.substring(0,20) + " ..." :  record.note }
                                    </span>
                                );
                            },
                        },
                
                        {
                            title: "Tổng tiền đ)",
                            render: (text, record) => {
                                return (
                                    <span>
                                       {record.total.toLocaleString()}
                                    </span>
                                );
                            },
                        },
                        {
                            title: "Trạng thái",
                            render: (text, record, index) => {
                                return (
                                    <Switch
                                        defaultChecked={record.status === 1}
                                        onChange={() => onChange(record)}
                                    />
                                );
                            },
                        },
                        {
                            title: "Ngày tạo",
                            render: (text, record, index) => {
                                return (
                                    <span>
                                        {moment(record.created_at).format(
                                            "DD/MM/YYYY"
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
                                            to={`/admin/products/ware-house/${record.id}`}
                                        >
                                            <EditFilled />
                                        </Link>
                                        <Popconfirm
                                            title="Xác nhận xoá"
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
export default WareHousePage;
