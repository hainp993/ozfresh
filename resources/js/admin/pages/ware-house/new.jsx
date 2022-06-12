import {
    message,
} from 'antd';
import Breadcrumb from '../../components/breadcrumbs';
import { useNavigate } from 'react-router';
import { useQueryClient } from 'react-query';
import Form from './form';

const CreateWareHousePage = () => {
    const navigate = useNavigate();
    const queryClient = useQueryClient();

    const onFinish = async (bill, billItems) => {
        bill.status =  bill.status ? 1 : 0;
        const values = {
            ...bill,
            billItems
        }
        try {
            await axios.post("/api/admin/ware-house/bill", values);
            console.log(values ,'values');
            message.success("Thêm tồn kho thành công");
            queryClient.invalidateQueries("product");
            navigate("/admin/products/ware-house");
        } catch ({ response }) {
            const { data } = response;
            message.error(data.message);
        }
    };


    return <div>
        <Breadcrumb items={["Tồn kho", "Thêm mới"]} />
        <div className="site-layout-background" style={{ padding: 24, minHeight: 360 }}>
            <div className="d-flex justify-content-center" >
                <Form onFinish={onFinish}
                />
            </div>
        </div>
    </div>
}
export default CreateWareHousePage;
