import { message } from "antd";
import Breadcrumb from "../../components/breadcrumbs";
import { useNavigate } from "react-router";
import { useQueryClient } from "react-query";
import Form from "./form";
import { useState } from "react";

const CreatCustomerPage = () => {
    const navigate = useNavigate();
    const queryClient = useQueryClient();

    const onFinish = async (values) => {
        values = { ...values}
        try {
            await axios.post("/api/admin/customer", values);
            message.success("Thêm khách hàng thành công");
            queryClient.invalidateQueries("customer");
            navigate("/admin/customer");
        } catch ({ response }) {
            const { data } = response;
            message.error(data.message);
        }
    };

    return (
        <div>
            <Breadcrumb items={["Bài viết", "Thêm mới"]} />
            <div
                className="site-layout-background"
                style={{ padding: 24, minHeight: 360 }}
            >
                <div className="d-flex justify-content-center">
                    <Form
                        onFinish={onFinish}
                        onChecked={(value) => setStatus(value)}
                        onEditor={(data) => setContent(data)}
                    />
                </div>
            </div>
        </div>
    );
};
export default CreatCustomerPage;
