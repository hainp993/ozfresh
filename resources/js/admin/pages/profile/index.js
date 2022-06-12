const { Button, Table, Popconfirm, message, Input, Space, Card ,Form} = require("antd");
import { DeleteFilled, EditFilled, CopyOutlined } from "@ant-design/icons";
import Breadcrumb from "../../components/breadcrumbs";
import { useNavigate } from "react-router";
import { useQueryClient, useQuery } from "react-query";
import { Link, useLocation } from "react-router-dom";
import { css } from "@emotion/react";
import { useEffect, useState } from "react";
import { useDebounce } from "../../../lib/hook";
import moment from "moment";
import Calendar from "../../components/calendar";
import Avatar from "antd/lib/avatar/avatar";

const ProfilePage = () => {
    const location = useLocation();
    const navigate = useNavigate();
    const queryClient = useQueryClient();
    const [search, setSearch] = useState(null);
    const [startDate, setStartDate] = useState();
    const [endDate, setEndDate] = useState();
    const [data, setData] = useState([]);
    const [isloading, setIsLoading] = useState(false)

    const debouncedSearchQuery = useDebounce(search, 600);

    const [pagination, setPagination] = useState({
        current: 1,
        pageSize: 5,
        total: 0,
    });

    useEffect(async () => {
        setIsLoading(true)
        const { data } = await axios.get("/api/admin/product-category/", {
            params: {
                page: pagination.current,
                pageSize: pagination.pageSize,
                search: debouncedSearchQuery,
                start_date: startDate ? startDate : null,
                end_date: endDate ? endDate : null,
            },
        });
        setPagination({
            ...pagination,
            total: data.total,
        });
        setData(data.data);
        setIsLoading(false)
    }, [pagination.current, debouncedSearchQuery, startDate, endDate]);

    const handleTableChange = (pagination, filters, sorter) => {
        setPagination(pagination);
    };

    const handleDelete = async (id) => {
        try {
            await axios.delete("/api/admin/product-category/" + id);
            const newData = data.filter(item => item.id !== id);
            setData(newData);
            message.success("Xoá thể loại thành công");
            queryClient.invalidateQueries("product-category");
        } catch ({ response }) {
            const { data } = response;
            message.error(data.error);
        }
    };
    const handlerUpdateProfile = () => {
        console.log(12321);
    }

    return (
        <div>
            <Card
        className="mx-auto text-center position-relative pt-5"
        style={{ width: 400 }}
      >
        {/* <div
          className="position-absolute top-0 start-0 w-100 py-5"
          style={{ background: "#74b9ff" }}
        ></div> */}
        <div>
          <Avatar
            className="custom-icon"
            size={80}
            style={{
            //   backgroundImage: `url(${userInfo.avatar})`,
              backgroundPosition: "center",
              border: "2px solid #fff",
            }}
          >
            {/* {userInfo?.name && userInfo.name[0]?.toUpperCase()} */}
          </Avatar>

          {/* <h4 className="mt-1">{userInfo.name ? userInfo.name : "Mr Admin"}</h4> */}
          <h4 className="mt-1">{"Mr Admin"}</h4>
        </div>
        <Form onFinish={handlerUpdateProfile}>
          <Form.Item
            name="email"
            wrapperCol={{
              offset: 0,
              span: 24,
            }}
            // defaultValue={user.email}
          >
            <div >
              <label htmlFor={'Email'} className="floating-label">
                Email
              </label>
              <Input
                name="email"
                onChange={'handlerInputChange'}
                // value={user.email}
              />
            </div>
          </Form.Item>
          <Form.Item
            name="name"
            wrapperCol={{
              offset: 0,
              span: 24,
            }}
          >
            <div >
              <label htmlFor={'user.name'} className="floating-label">
                Họ tên
              </label>
              <Input
                name="name"
                onChange={'handlerInputChange'}
                // value={user.name}
              />
            </div>
          </Form.Item>
          <Form.Item
            name="mobile"
            wrapperCol={{
              offset: 0,
              span: 24,
            }}
          >
            <div >
              <label htmlFor={'user.mobile'} className="floating-label">
                Số điện thoại
              </label>
              <Input
                name="mobile"
                // onChange={handlerInputChange}
                value={'user.mobile'}
              />
            </div>
          </Form.Item>
          <Form.Item
            name="password"
            wrapperCol={{
              offset: 0,
              span: 24,
            }}
          >
            <label htmlFor={'user.password'} className="floating-label">
              Mật khẩu
            </label>
            <Input.Password
              name="password"
              placeholder="*******"
              value={'user.password'}
            //   onChange={handlerInputChange}
            />
          </Form.Item>
          <div className="d-flex justify-content-start pt-3">
            <Button htmlType="submit" type="primary">
              Cập nhật
            </Button>
          </div>
        </Form>
      </Card>
        </div>
    );
};
export default ProfilePage;
