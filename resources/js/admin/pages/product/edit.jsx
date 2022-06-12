import {
    message, Skeleton,
} from 'antd';
import Breadcrumb from '../../components/breadcrumbs';
import { useNavigate, useParams } from 'react-router';
import { useQueryClient, useQuery } from 'react-query';
import Form from './form';

const EditProductPage = () => {
    const navigate = useNavigate();
    const queryClient = useQueryClient();
    const { id } = useParams();

    const { isLoading, data } = useQuery(['product-category', [id]], async () => {
        const { data } = await axios.get("/api/admin/product/" + id);
    
         return data;
        
    });
    

    const onFinish = async (values) => {
        console.log(values,'values');
        if(values && values.categories && values.categories.length){
            values.categories = values.categories.map(item => ({category_id: item}))
        }
        try {
            await axios.put("/api/admin/product/" + id, values);
            message.success("Sữa sách thành công");
            queryClient.invalidateQueries("product-category");
            navigate("/admin/products/product");
        } catch ({ response }) {
            const { data } = response;
            message.error(data.message);
        }
    };

    return <div>
        <Breadcrumb items={["thể loại sách", "Cập nhật"]} />
        <div className="site-layout-background" style={{ padding: 24, minHeight: 360 }}>
            <div className="d-flex justify-content-center" >
                <Skeleton active loading={isLoading}>
                    <Form
                        isEdit
                        initialValues={data}
                        onFinish={onFinish}
                    />
                </Skeleton>
            </div>
        </div>
    </div>
}
export default EditProductPage;
