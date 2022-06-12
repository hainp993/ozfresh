import { message } from "antd";
import Breadcrumb from "../../components/breadcrumbs";
import { useNavigate } from "react-router";
import { useQueryClient } from "react-query";
import Form from "./form";

const CreateCategoryPage = () => {
    const navigate = useNavigate();
    const queryClient = useQueryClient();

    const onFinish = async (values) => {
        console.log(values);
        try {
            await axios.post("/api/admin/category", values);
            message.success("Thêm thể loại thành công");
            queryClient.invalidateQueries("category");
            navigate("/admin/category");
        } catch ({ response }) {
            const { data } = response;
            message.error(data.message);
        }
    };

    return (
        <div>
            <Breadcrumb items={["thể loại", "Thêm mới"]} />
            <div
                className="site-layout-background"
                style={{ padding: 24, minHeight: 360 }}
            >
                <div className="d-flex justify-content-center">
                    <Form onFinish={onFinish} />
                </div>
            </div>
        </div>
    );
};
export default CreateCategoryPage;
