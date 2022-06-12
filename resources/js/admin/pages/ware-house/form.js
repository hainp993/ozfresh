import { css } from "@emotion/react";
import {
    Form,
    Input,
    Button,
    Switch,
    InputNumber,
    Select,
    Card,
    Space,
    DatePicker,
} from "antd";

import React, { useEffect, useState } from "react";
import { PlusOutlined } from "@ant-design/icons";
import moment from 'moment';
import axios from "axios";

const { TextArea } = Input;

const ProductForm = ({ onFinish, isEdit, getContent, ...props }) => {
    const [form] = Form.useForm();
    const [products, setProducts] = useState([]);
    const [bill, setBill] = useState([]);
    const [billItems, setBillItems] = useState([]);

    const handleIncreaseBillItem = () => {
        const billItem = {};
        setBillItems([...billItems,billItem])
    }

    const handleChangeInputBill = (name,value) => {
        const billItem =  bill ?? {};
        billItem[name] = value;
        if(name.indexOf('date') !== -1){
            billItem[name] = moment(value).format('YYYY-MM-DD');
        }
        setBill(billItem);
    }


    const handleChangeInputBillItem = (name,value,index) => {
        const billItem =  billItems[index] ?? {};
        billItem[name] = value;
        if(name.indexOf('date') !== -1){
            billItem[name] = moment(value).format('YYYY-MM-DD');
        }
        
        billItems[index] = billItem;
        setBillItems(billItems);
    }


    useEffect(async () => {
        await axios.get("/api/admin/product/").then((data) => {
            setProducts(data.data.data);
        });
    }, []);

    return (
        <Card bordered={true} style={{ width: 650 }}>
            <Form
                css={css`
                    width: 600px;
                `}
                labelCol={{
                    span: 6,
                }}
                form={form}
                billItems={billItems}
                onFinish={() => {onFinish ( bill, billItems)} }
                scrollToFirstError
                {...props}
            >
                <div className="site-card-border-less-wrapper mb-4">
                    <Card bordered={true} style={{ width: 600 }} title="Tổng">
                        <Form.Item name="date" label="Ngày nhập ">
                            <Space direction="vertical">
                                <DatePicker name="date" onChange={(e) => {handleChangeInputBill('date',e) }}  />
                            </Space>
                        </Form.Item>
                        <Form.Item
                            name="total"
                            label="Tổng chi phí"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng nhập giá",
                                },
                            ]}
                        >
                            <InputNumber
                                min={1000}
                                max={950000000}
                                defaultValue={0}
                                onChange={(e) => {handleChangeInputBill('total',e) }}
                            />
                        </Form.Item>
                        <Form.Item name="note" label="Ghi chú">
                            <TextArea row={6}  onChange={(e) => {handleChangeInputBill('note',e.target.value) }} />
                        </Form.Item>
                        <Form.Item
                            name="status"
                            label="Trạng thái"
                            valuePropName="checked"
                        >
                            <Switch
                                onChange={(e) => {handleChangeInputBill('status',e) }}
                                defaultChecked={
                                    props.initialValues === 0
                                        ? props.initialValues?.status
                                        : 0
                                }
                            />
                        </Form.Item>
                    </Card>
                </div>

                {billItems &&
                    billItems.map((item,index) => (
                        <div className="site-card-border-less-wrapper">
                            <Card
                                bordered={true}
                                style={{ width: 600 }}
                                title="Chi tiết"
                            >
                                <Form.Item name={`date-${index}`} label="Ngày nhập ">
                                    <Space direction="vertical">
                                        <DatePicker  onChange={(e) => {handleChangeInputBillItem('date',e,index) }}/>
                                    </Space>
                                </Form.Item>
                                <Form.Item
                                    name={`productIds-${index}`}
                                    label="sách"
                                    rules={[
                                        {
                                            required: true,
                                            message: "Vui lòng chọn sách",
                                        },
                                    ]}
                                >
                                    <Select
                                        name={`productId-${index}`}
                                        allowClear
                                        filterOption={(inputValue, option) =>
                                            option.props.children
                                                .toString()
                                                .toLowerCase()
                                                .includes(
                                                    inputValue.toLowerCase()
                                                )
                                        }
                                        style={{ width: "100%" }}
                                        placeholder="Chọn sách"
                                        onChange={(e) => {handleChangeInputBillItem('product_id',e,index) }}
                                    >
                                        {products.map((item) => (
                                            <Option
                                                key={item.id}
                                                value={item.id}
                                            >
                                                {item.name}
                                            </Option>
                                        ))}
                                    </Select>
                                </Form.Item>
                                <Form.Item
                                    name={`quantity-${index}`}
                                    label="Số lượng"
                                    rules={[
                                        {
                                            required: true,
                                            message: "Vui lòng nhập Số lượng",
                                        },
                                    ]}
                                >
                                    <InputNumber
                                        min={0}
                                        max={100}
                                        defaultValue={0}
                                        onChange={(e) => {handleChangeInputBillItem('quantity',e,index) }}
                                    />
                                </Form.Item>
                                <Form.Item
                                    name={`amount-${index}`}
                                    label="Giá thành"
                                    rules={[
                                        {
                                            required: true,
                                            message: "Vui lòng nhập giá",
                                        },
                                    ]}
                                >
                                    <InputNumber
                                        min={1000}
                                        max={950000000}
                                        defaultValue={0}
                                        onChange={(e) => {handleChangeInputBillItem('amount',e,index) }}
                                    />
                                </Form.Item>
                                <Form.Item 
                                    name={`note-${index}`}
                                    label="Ghi chú"
                                
                                >
                                    <TextArea row={6}  onChange={(e) => {handleChangeInputBillItem('note',e.target.value,index) }}/>
                                </Form.Item>
                            </Card>
                        </div>
                    ))}
                <div class="d-flex justify-content-end mt-2">
                    <Button onClick={handleIncreaseBillItem} primary icon={<PlusOutlined />} size={100} />
                </div>
                

                <Form.Item className="float-right mt-4">
                    <Button type="primary" htmlType="submit">
                        {isEdit ? "Cập nhật" : "Thêm mới"}
                    </Button>
                </Form.Item>
            </Form>
        </Card>
    );
};

export default ProductForm;
