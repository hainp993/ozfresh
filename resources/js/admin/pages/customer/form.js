import { css } from "@emotion/react";
import {
    Button, Form,
    Input ,DatePicker ,Col ,Checkbox ,Radio,Upload,Image,Progress
} from "antd";
import React, { useState } from "react";
import { useQuery } from "react-query";
import moment from "moment";
import {
    InboxOutlined,
} from "@ant-design/icons";
import Calendar from "../../components/calendar";
const ContactForm = ({ onFinish, isEdit, ...props }) => {

    const [form] = Form.useForm();
    const { isLoading, data } = useQuery(["customer"], async () => {
        const { data } = await axios.get("/api/admin/customer");
        return data;
    });

    const [isActive, setIsActive] = useState(true);

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

    const [progress, setProgress] = useState(0);

    const [value, setValue] = React.useState(0);

    function onChange(e) {
    console.log('radio checked', e.target.value);
    setValue(e.target.value);

    
   
  };
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
                label="T??n kh??ch h??ng"
                rules={[
                    {
                        required: true,
                        message: "Vui l??ng nh???p t??n kh??ch h??ng",
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
                        message: "Vui l??ng nh???p email",
                    },
                ]}
            >
                <Input />
            </Form.Item>
            <Form.Item
                name="fullName"
                label="H??? v?? t??n"
                rules={[
                    {
                        required: true,
                        message: "Vui l??ng nh???p h??? v?? t??n",
                    },
                ]}
            >
                <Input />
            </Form.Item>
            <Form.Item
                name="address"
                label="?????a ch???"
                rules={[
                    {
                        required: true,
                        message: "Vui l??ng nh???p ?????a ch???",
                    },
                ]}
            >
                <Input />
            </Form.Item>
            <Form.Item
                name="birthday"
                label="Ng??y sinh"
                rules={[
                    {
                        required: true,
                        message: "Vui l??ng nh???p ?????a ch???",
                    },
                ]}
            >
                <Calendar 
                autoFocus
                  name="birthday"
                  onChange={(value) => moment(value).format("YYYY-MM-DD")}
                  />
            </Form.Item>
            <Form.Item
                label="Gi???i t??nh"
                name="gender"
            >
                <Radio.Group onChange={onChange} value={value}>
                    <Radio value={0}>Nam</Radio>
                    <Radio value={1}>N???</Radio>
                </Radio.Group>
            </Form.Item>
            <Form.Item
                name="phone"
                label="S??? ??i???n tho???i"
                rules={[
                    {
                        required: true,
                        message: "Vui l??ng nh???p s??? ??i???n tho???i",
                    },
                ]}
            >
                <Input />
            </Form.Item>
            <Form.Item
                name="facebook"
                label="Facebook"
                rules={[
                    {
                        required: true,
                        message: "Vui l??ng facebook",
                    },
                ]}
            >
                <Input />
            </Form.Item>
            <Form.Item className="float-right">
                <Button type="primary" htmlType="submit">
                    {isEdit ? "C???p nh???t" : "Th??m m???i"}
                </Button>
            </Form.Item>
        </Form>
    );
};

export default ContactForm;
