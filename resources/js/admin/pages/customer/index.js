const { Button, Table, Popconfirm, message, Input, Space } = require("antd");
import { DeleteFilled, EditFilled, CopyOutlined } from "@ant-design/icons";
import Breadcrumb from "../../components/breadcrumbs";
import { useNavigate } from "react-router";
import { useQueryClient, useQuery } from "react-query";
import { Link, useLocation } from "react-router-dom";
import { css } from "@emotion/react";
import React, { useEffect, useState } from "react";
import { useDebounce } from "../../../lib/hook";

import moment from "moment";
import Calendar from "../../components/calendar";

const CustomerPage = () => {
    const location = useLocation();
    const navigate = useNavigate();
    const queryClient = useQueryClient();
    const [search, setSearch] = useState(null);
    const [startDate, setStartDate] = useState();
    const [endDate, setEndDate] = useState();
    const [data, setData] = useState([]);

    const debouncedSearchQuery = useDebounce(search, 600);

    const [pagination, setPagination] = useState({
        current: 1,
        pageSize: 5,
        total: 0,
    });

    useEffect(async () => {
        const { data } = await axios.get("/api/admin/customer", {
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
    }, [pagination.current, search, startDate, endDate]);

    const handleTableChange = (pagination, filters, sorter) => {
        setPagination(pagination);
    };

    const handleDelete = async (id) => {
        try {
            await axios.delete("/api/admin/customer/" + id);
            message.success("Xo?? kh??ch h??ng th??nh c??ng");
            queryClient.invalidateQueries("customer");
        } catch ({ response }) {
            const { data } = response;
            message.error(data.error);
        }
    };

    return (
        <div>
            <Breadcrumb items={["th??? lo???i"]}>
                <Space>
                    <Button
                        onClick={() => navigate("/admin/customer/new")}
                        className="ml-auto"
                        type="primary"
                    >
                        Th??m kh??ch h??ng
                    </Button>
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
                    footer={() => `T???ng s??? kh??ch h??ng ${pagination.total}`}
                    rowKey={(record) => record.id}
                    pagination={pagination}
                    onChange={handleTableChange}
                    columns={[
                        {
                            title: "STT",
                            render: (text, record, index) => index + 1,
                        },
                        {
                            title: "H??? t??n",
                            dataIndex: "name",
                            render: (text, record, index) => {
                                return (
                                    <span>
                                        {record.profile ? record.profile.name : "12"}
                                    </span>
                                );
                            },
                        },
                        {
                            title: "Gi???i t??nh",
                            dataIndex: "profile.gender",
                            key: "profile.gender",
                            className: "text-center",
                            render: (text, record) => (
                              <>
                              <span
                                    style={{ cursor: "pointer", minWidth: 100 }}
                                  >
                                    {record.profile ? record.profile.gender === 0 ? 'Nam' : 'N???' : ""}
                                  </span>
                              </>
                            ),
                          },
                        {
                            title: "Ng??y sinh",
                            render: (text, record, index) => {
                                return (
                                    <span>
                                        {record.profile ? moment(record.profile.birthday).format(
                                            "DD/MM/YYYY"
                                        ) :""}
                                    </span>
                                );
                            },
                        },
                        {
                            title: "?????a ch???",
                            dataIndex: "profile.address",
                            render: (text, record, index) => {
                                return (
                                    <span>
                                       {record.profile ? record.profile.address : ""}
                                    </span>
                                );
                            },
                        },
                        {
                            title: "S??? ??i???n tho???i",
                            dataIndex: "profile.phone",
                            render: (text, record, index) => {
                                return (
                                    <span>
                                        {record.profile ? record.profile.phone : "03262786307"}
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
                                            to={`/admin/customer/${record.id}`}
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
                />
            </div>
        </div>
    );
};
export default CustomerPage;
