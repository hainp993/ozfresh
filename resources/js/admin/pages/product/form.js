import { css } from "@emotion/react";
import {
    Form,
    Input,
    Button,
    Upload,
    Progress,
    Image,
    Spin,
    Row,
    Col,
    Divider,
    Switch,
    InputNumber,
    Select
} from "antd";
import React, { useEffect, useState } from "react";
import { useQuery } from "react-query";
import {
    InboxOutlined,
    PlusOutlined,
    MinusCircleOutlined,
} from "@ant-design/icons";
import { CKEditor } from "@ckeditor/ckeditor5-react";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import axios from "axios";

const { TextArea } = Input;

const ProductForm = ({ onFinish, isEdit, getContent, ...props }) => {

    const [form] = Form.useForm();
    const [categoriesProduct, setcategoriesProduct] = useState([]);
    const [authorProduct, setauthorProduct] = useState([]);
    const [publisherProduct, setpublisherProduct] = useState([]);
    
    useEffect(async () => {
        await axios.get("/api/admin/product-category/").then((data) => {
            setcategoriesProduct(data.data.data)
        })
    }, []);
    useEffect(async () => {
        await axios.get("/api/admin/author/").then((data) => {
            setauthorProduct(data.data.data)
        })
    }, []);

    useEffect(async () => {
        await axios.get("/api/admin/publisher/").then((data) => {
            setpublisherProduct(data.data.data)
        })
    }, []);
    const [content, setContent] = useState('');

    const [isActive, setIsActive] = useState(true);

    const [defaultFileList, setDefaultFileList] = useState(
        props.initialValues
            ? [
                {
                    id: -1,
                    status: "done",
                    url: asset(props.initialValues.thumbnail),
                },
            ]
            : []
    );


    const [progress, setProgress] = useState(0);

    const uploadImage = async (options) => {
        const { onSuccess, onError, file, onProgress } = options;

        const fmData = new FormData();
        const config = {
            headers: { "content-type": "multipart/form-data" },
            onUploadProgress: (event) => {
                const percent = Math.floor((event.loaded / event.total) * 100);
                setProgress(percent);
                if (percent === 100) {
                    setTimeout(() => setProgress(0), 1000);
                }
                onProgress({ percent: (event.loaded / event.total) * 100 });
            },
        };
        fmData.append("file", file);
        try {
            const res = await axios.post("/api/admin/upload", fmData, config);

            return onSuccess(res.data.file);
        } catch (err) {
            console.log("Eroor: ", err);
            const error = new Error("Some error");
            onError({ err });
        }
    };

    const handleOnChange = ({ file, fileList, event }) => {
        if (file.status == "done") {
            setDefaultFileList([
                {
                    id: file.uid,
                    status: "done",
                    url: file.response,
                },
            ]);
        }
    };

    const handleChecked = (checked) => {
        setIsActive(checked);
        props.onChecked(checked)
    }

    const handleGetContent = (data) => {
        props.onEditor(data)
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
                name="name"
                label="T??n s??ch"
                rules={[
                    {
                        required: true,
                        message: "Vui l??ng nh???p s??ch",
                    },
                ]}
            >
                <Input />
            </Form.Item>
            <Form.Item name="author" label="t??c gi???" rules={[{ required: true }]}>
                        <Select
                            name={'author'}
                            allowClear
                            style={{ width: '100%' }}
                            placeholder="Please select"
                            
                        >
                            {authorProduct.map((item) => (
                                <Option key={item.id} value={item.id}>
                                    {item.name}
                                </Option>
                            ))}
                        </Select>
            </Form.Item>
            <Form.Item name="publisher" label="nh?? xu???t b???n" rules={[{ required: true }]}>
                        <Select
                            name={'publisher'}
                            allowClear
                            style={{ width: '100%' }}
                            placeholder="Please select"
                            
                        >
                            {publisherProduct.map((item) => (
                                <Option key={item.id} value={item.id}>
                                    {item.name}
                                </Option>
                            ))}
                        </Select>
            </Form.Item>
            <Form.Item label="???nh ?????i di???n">
                {defaultFileList.length > 0 && (
                    <Image src={defaultFileList[0].url} />
                )}
                <Form.Item
                    rules={[
                        {
                            required: true,
                            message: "Vui l??ng t???i ???nh ?????i di???n cho b??i vi???t",
                        },
                    ]}
                    name="thumbnail"
                    valuePropName="file"
                    getValueFromEvent={(e) => e && e.file.response}
                    noStyle
                >
                    <Upload.Dragger
                        name="file"
                        accept="image/*"
                        multiple={false}
                        customRequest={uploadImage}
                        onChange={handleOnChange}
                        listType="picture-card"
                        defaultFileList={defaultFileList}
                        className="image-upload-grid"
                        showUploadList={false}
                    >
                        <div>
                            <p className="ant-upload-drag-icon">
                                <InboxOutlined />
                            </p>
                            <p className="ant-upload-text">
                                K??o ???nh v??o ????? t???i ???nh l??n
                            </p>
                        </div>
                        {progress > 0 ? <Progress percent={progress} /> : null}
                    </Upload.Dragger>
                </Form.Item>
            </Form.Item>
            <Form.Item
                name="sale"
                label="Khuy???n m??i"
            >
                <InputNumber min={1} max={95} defaultValue={0} />
            </Form.Item>
            <Form.Item
                name="quantity"
                label="S??? l?????ng"
                rules={[
                    {
                        required: true,
                        message: "Vui l??ng nh???p S??? l?????ng",
                    },
                ]}
            >
                <InputNumber min={1} max={100} defaultValue={1} />
            </Form.Item>
            <Form.Item
                name="price"
                label="Gi?? th??nh"
                rules={[
                    {
                        required: true,
                        message: "Vui l??ng nh???p gi??",
                    },
                ]}
            >
                <InputNumber min={1000} max={950000000} defaultValue={0} />
            </Form.Item>


            <Form.Item name="description" label="M?? t???">
                <TextArea row={6} />
            </Form.Item>

                <Form.Item name="categories" label="th??? lo???i" rules={[{ required: true }]}>
                        <Select
                            name={'categories'}
                            mode="multiple"
                            allowClear
                            style={{ width: '100%' }}
                            placeholder="Please select"
                            
                        >
                            {categoriesProduct.map((item) => (
                                <Option key={item.id} value={item.id}>
                                    {item.name}
                                </Option>
                            ))}
                        </Select>
            </Form.Item>
            


            <Form.Item className="float-right">
                <Button type="primary" htmlType="submit">
                    {isEdit ? "C???p nh???t" : "Th??m m???i"}
                </Button>
            </Form.Item>
        </Form>
    );
};

export default ProductForm;
