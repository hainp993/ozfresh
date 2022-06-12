import {
    message,
} from 'antd';
import Breadcrumb from '../../components/breadcrumbs';
import { useNavigate } from 'react-router';
import { useQueryClient } from 'react-query';
import Form from './form';

const CreateProductPage = () => {
    const navigate = useNavigate();
    const queryClient = useQueryClient();

    const onFinish = async (values) => {

        if(values && values.categories && values.categories.length){
            values.categories = values.categories.map(item => ({category_id: item}))
        }
        try {
            await axios.post("/api/admin/product", values);
            console.log(values ,'values');
            message.success("Thêm sách thành công");
            queryClient.invalidateQueries("product");
            navigate("/admin/products/product");
        } catch ({ response }) {
            const { data } = response;
            message.error(data.message);
        }
    };


    return <div>
        <Breadcrumb items={["thể loại sách", "Thêm mới"]} />
        <div className="site-layout-background" style={{ padding: 24, minHeight: 360 }}>
            <div className="d-flex justify-content-center" >
                <Form onFinish={onFinish}
                />
            </div>
        </div>
    </div>
}
export default CreateProductPage;
