import { css } from "@emotion/react";
import {
    Button, Form,
    Input,Switch
} from "antd";
import React, { useState } from "react";
import { ShoppingCartOutlined, PlusCircleOutlined, MinusCircleOutlined } from '@ant-design/icons';
import { Row, Col, message, Select, InputNumber, Tooltip, Radio } from 'antd';
import { useQuery } from "react-query";

const { TextArea } = Input;
const ProductCategoryForm = ({ onFinish, isEdit, ...props }) => {
    const [form] = Form.useForm();

    const { isLoading, data } = useQuery(["order"], async () => {
        const { data } = await axios.get("/api/admin/order");
        return data;
    });
    const [isActive, setIsActive] = useState(1);

    const handleChecked = (checked) => {
        setIsActive(checked);
     props.onChecked(checked)
    }
    return (
        <Form
            css={css`
                width: 600px;
            `}
            labelCol={{
                span: 6,
            }}
            form={form}
            onFinish={onFinish}
            scrollToFirstError
            {...props}
        >
            <Form.Item
                name="fullName"
                label="Họ tên"
                rules={[
                    {
                        required: true,
                        message: "Vui lòng nhập họ tên",
                    },
                ]}
            >
                <Input />
            </Form.Item>
            <Form.Item
                name="email"
                label="Email"
                rules={[
                    {
                        required: true,
                        message: "Nhập địa chi email",
                    },
                    {
                        type: 'email',
                        message: 'Khống đúng dịnh dạng email',
                      },
                ]}
            >
                <Input />
            </Form.Item>
            <Form.Item
                name="ship_address"
                label="Địa chỉ"
                rules={[
                    {
                        required: true,
                        message: "Vui lòng nhập địa chỉ ",
                    },
                ]}
            >
                <Input />
            </Form.Item>
            <Form.Item
                name="phone"
                label="Số điện thoại"
                rules={[
                    {
                        required: true,
                        message: "Vui lòng nhập sdt",
                    },
                ]}
            >
                <Input />
            </Form.Item>

            <Form.Item
                name="note"
                label="Nội dung"
                rules={[
                    {
                        required: true,
                        message: "Vui lòng nhập Nội dung",
                    },
                ]}
            >
                <Input />
            </Form.Item>
            <Form.Item
                name="total"
                label="Thành tiền"
                rules={[
                    {
                        required: true,
                        message: "Vui lòng nhập thành tiền",
                    },
                ]}
            >
                <Input />
            </Form.Item>
            <Form.Item name="status" label="Trạng thái" valuePropName="checked">
                <Switch defaultChecked={props.initialValues === 0 ? props.initialValues?.status :0} onChange={(checked) => handleChecked(checked)} />
            </Form.Item>
            <Form.Item className="float-right">
                <Button type="primary" htmlType="submit">
                    {isEdit ? "Cập nhật" : "Thêm mới"}
                </Button>
            </Form.Item>
        </Form>
    );
};

export default ProductCategoryForm;
