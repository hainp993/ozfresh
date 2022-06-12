import {
  message, Skeleton,
} from 'antd';
import Breadcrumb from '../../components/breadcrumbs';
import { useNavigate, useParams } from 'react-router';
import { useQueryClient, useQuery } from 'react-query';
import Form from './form';
import { useState } from "react";

const EditCustomerPage = () => {
  const navigate = useNavigate();
  const queryClient = useQueryClient();
  const { id } = useParams();
  const [content, setContent] = useState('')

  const { isLoading, data } = useQuery(['customer', [id]], async () => {
      const { data } = await axios.get("/api/admin/customer/" + id);
      return data.profile;
      
  });

  const onFinish = async (values) => {
      try {
          values = { ...values}
          console.log(values ,'values');
          await axios.put("/api/admin/customer/" + id, values);
          message.success("Sữa khách hàng thành công");
          queryClient.invalidateQueries("customer");
          navigate("/admin/customer");
      } catch ({ response }) {
          const { data } = response;
            
          message.error(data.message);
      }
  };

  return <div>
      <Breadcrumb items={["Tin tức", "Thêm mới"]} />
      <div className="site-layout-background" style={{ padding: 24, minHeight: 360 }}>
          <div className="d-flex justify-content-center" >
              <Skeleton active loading={isLoading}>
                  <Form
                      isEdit
                      initialValues={data}
                      onFinish={onFinish}
                      onChecked={(value) => setStatus(value)}
                      onEditor={(data) => setContent(data)}
                  />
              </Skeleton>
          </div>
      </div>
  </div>
}
export default EditCustomerPage;
