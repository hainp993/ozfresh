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
} from "antd";
import React, { useState } from "react";
import { useQuery } from "react-query";
import {
    InboxOutlined,
    PlusOutlined,
    MinusCircleOutlined,
} from "@ant-design/icons";
import { CKEditor } from "@ckeditor/ckeditor5-react";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

const { TextArea } = Input;
const BlogPostForm = ({ onFinish, isEdit, getContent, ...props }) => {
    const [form] = Form.useForm();

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
                name="title"
                label="T??n ti??u ?????"
                rules={[
                    {
                        required: true,
                        message: "Vui l??ng nh???p ti??u ?????",
                    },
                ]}
            >
                <Input />
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
                name="slug"
                label="???????ng d???n"
            >
                <Input
                addonBefore={"http://"+window.location.origin}
                />
            </Form.Item>

            <Form.Item className="control-75" name="content" label="N???i dung b??i vi???t"  rules={[
                    {
                        required: true,
                        message: "Vui l??ng nh???p n???i dung b??i vi???t",
                    },
                ]}>
                <CKEditor
                    className="content"
                    editor={ClassicEditor}
                    data={props.initialValues ? props.initialValues?.content : ""}
                    onChange={(event, editor) => {
                        const data = editor.getData();
                        setContent(data);
                        handleGetContent(data)
                    }}
                />
            </Form.Item>

            <Form.Item name="description" label="M?? t???">
                <TextArea row={6} />
            </Form.Item>

            <Form.Item name="status" label="Tr???ng th??i" valuePropName="checked">
                <Switch defaultChecked={props.initialValues === 1 ? props.initialValues?.status : true} onChange={(checked) => handleChecked(checked)} />
            </Form.Item>

            <Form.Item className="float-right">
                <Button type="primary" htmlType="submit">
                    {isEdit ? "C???p nh???t" : "Th??m m???i"}
                </Button>
            </Form.Item>
        </Form>
    );
};

export default BlogPostForm;
