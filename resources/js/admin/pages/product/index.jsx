const {
    Button,
    Table,
    Popconfirm,
    message,
    Input,
    Space,
    Switch,
} = require("antd");
import { DeleteFilled, EditFilled, CopyOutlined } from "@ant-design/icons";
import Breadcrumb from "../../components/breadcrumbs";
import { useNavigate } from "react-router";
import { useQueryClient, useQuery } from "react-query";
import { Link, useLocation } from "react-router-dom";
import { css } from "@emotion/react";
import { useEffect, useState } from "react";
import { useDebounce } from "../../../lib/hook";
import moment from "moment";
import Calendar from "../../components/calendar";

const ProductPage = () => {
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
        const { data } = await axios.get("/api/admin/product/", {
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
        setIsLoading(false);
    }, [pagination.current, debouncedSearchQuery, startDate, endDate]);

    const handleTableChange = (pagination, filters, sorter) => {
        setPagination(pagination);
    };

    const handleDelete = async (id) => {
        try {
            await axios.delete("/api/admin/product/" + id);
            const newData = data.filter((item) => item.id !== id);
            setData(newData);
            message.success("Xo?? tin t???c th??nh c??ng");
            queryClient.invalidateQueries("product");
        } catch ({ response }) {
            const { data } = response;
            message.error(data.error);
        }
    };
    const showItemBook = (id) => {
        console.log(id);
    };
    return (
        <div>
            <Breadcrumb items={["s??ch"]}>
                <Space>
                    <Button
                        onClick={() => navigate("/admin/products/product/new")}
                        className="ml-auto"
                        type="primary"
                    >
                        Th??m s??ch
                    </Button>
                    <Input
                        placeholder="T??m ki???m"
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
                            title: "???nh ?????i di???n",
                            render: (text, record, index) => {
                                return (
                                    <img
                                        src={record.thumbnail}
                                        alt={record.title}
                                        style={{
                                            width: "50px",
                                            height: "50px",
                                        }}
                                    />
                                );
                            },
                        },
                        {

                            width:"250px",
                            title: "T??n s??ch",
                            dataIndex: "name",
                        },

                        
                        {
                            title: "Nh?? cung c???p",
                            dataIndex: "description",
                        },
                        {
                            title: "S??? l?????ng t???n",
                            dataIndex: "quantity",
                        },
                        {
                            title: "Th??nh ti???n (??)",
                            dataIndex: "price",
                            render: (text, record) => {
                                return (
                                    <span>{record.price.toLocaleString()}</span>
                                );
                            },
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
                                            to={`/admin/products/product/${record.id}`}
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
export default ProductPage;
