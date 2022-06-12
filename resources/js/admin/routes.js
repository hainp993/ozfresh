import { lazy } from "react";
import {
    ShoppingCartOutlined,
    SkinOutlined,
    BookOutlined,
    ContactsOutlined,
    UsergroupAddOutlined,
    DashboardOutlined,
    PieChartOutlined,
} from "@ant-design/icons";
import CreateContactPage from "./pages/contact/new";
import CreatCustomerPage from "./pages/customer/new";
import EditCustomerPage from "./pages/customer/edit";
import ContactPage from "./pages/contact";
import CustomerPage from "./pages/customer";
import Dashboard from "./pages/dashboard";
import OrderProduct from "./pages/order-product";
import EditContactPage from "./pages/contact/edit";
import BlogCategoryPage from "./pages/blog_category";
import ProductCategoryPage from "./pages/product-category";

import AuthorPage from "./pages/author";
import CreateAuthorPage from "./pages/author/new";
import EditAuthorPage from "./pages/author/edit";


import PublisherPage from "./pages/publisher";
import CreatePublisherPage from "./pages/publisher/new";
import EditPublisherPage from "./pages/publisher/edit";


import CreateBlogCategoryPage from "./pages/blog_category/new";
import CreateOrderProduct from "./pages/order-product/new";
import EditOrderProduct from "./pages/order-product/edit";
import CreateProductsCategoryPage from "./pages/product-category/new";
import EditBlogCategoryPage from "./pages/blog_category/edit";
import EditProductsCategoryPage from "./pages/product-category/edit";
import BlogPostPage from "./pages/blog-post";

import ProductPage from "./pages/product";
import CreateProductPage from "./pages/product/new";
import EditProductPage from "./pages/product/edit";

import WareHousePage from "./pages/ware-house";
import CreateWareHousePage from "./pages/ware-house/new";
import EditWareHousePage from "./pages/ware-house/edit";

import CreateBlogPostPage from "./pages/blog-post/new";
import EditBlogPostPage from "./pages/blog-post/edit";
import ReportCustomer from "./pages/report/customer";
import ReportProduct from "./pages/report/product";
import ReportRevenue from "./pages/report/revenue";
import ProfilePage from "./pages/profile";

const routes = [
    {
        path: "home",
        title: "Tổng quan",
        icon: <DashboardOutlined />,
        component: Dashboard,
    },
    {
        path: "report",
        title: "Báo cáo",
        icon: <PieChartOutlined />,
        childs: [
            {
                title: "Báo cáo doanh thu",
                path: "revenue",
                component: ReportRevenue,
            },
            {
                path: "customer",
                title: "Báo cáo khách hàng",
                component: ReportCustomer,
            },
            // {
            //     path: "product",
            //     title: "Báo cáo sách",
            //     component: ReportProduct,
            // },
        ],
    },
    {
        path: "customer",
        title: "Khách hàng",
        icon: <UsergroupAddOutlined />,
        childs: [
            {
                title: "Quản lý khách hàng",
                path: "",
                component: CustomerPage,
            },
            {
                path: "new",
                title: "Thêm khách hàng",
                component: CreatCustomerPage,
                hidden: true,
            },
            {
                path: ":id",
                title: "Sửa khách hàng",
                hidden: true,
                component: EditCustomerPage,
            },
        ],
    },

    {
        path: "products",
        title: "sách",
        icon: <SkinOutlined />,
        childs: [
            {
                title: "Quản lý thể loại sách",
                path: "category",
                component: ProductCategoryPage,
            },
            {
                path: "category-product/new",
                title: "Thêm thể loại sách",
                component: CreateProductsCategoryPage,
                hidden: true,
            },
            {
                path: "category-product/:id",
                title: "Sửa thể loại sách",
                hidden: true,
                component: EditProductsCategoryPage,
            },
            {
                title: "Quản lý tác giả",
                path: "author",
                component: AuthorPage,
            },
            {
                path: "author/new",
                title: "Thêm tác giả",
                component: CreateAuthorPage,
                hidden: true,
            },
            {
                path: "author/:id",
                title: "Sửa tác giả",
                hidden: true,
                component: EditAuthorPage,
            },
            {
                title: "Quản lý nhà xuất bản",
                path: "publisher",
                component: PublisherPage,
            },
            {
                path: "publisher/new",
                title: "Thêm tác giả",
                component: CreatePublisherPage,
                hidden: true,
            },
            {
                path: "publisher/:id",
                title: "Sửa tác giả",
                hidden: true,
                component: EditPublisherPage,
            },
            {
                title: "Quản lý sách",
                path: "product",
                component: ProductPage,
            },
            {
                path: "product/new",
                title: "Thêm sách",
                component: CreateProductPage,
                hidden: true,
            },
            {
                path: "product/:id",
                title: "Sửa sách",
                hidden: true,
                component: EditProductPage,
            },

            {
                title: "Quản lý tồn kho",
                path: "ware-house",
                component: WareHousePage,
            },
            {
                path: "ware-house/new",
                title: "Thêm tồn kho",
                component: CreateWareHousePage,
                hidden: true,
            },
            {
                path: "ware-house/:id",
                title: "Sửa tồn kho",
                hidden: true,
                component: EditWareHousePage,
            },
        ],
    },
    {
        path: "order",
        title: "Đơn hàng",
        icon: <ShoppingCartOutlined />,
        childs: [
            {
                title: "Quản lý đơn hàng",
                path: "",
                component: OrderProduct,
            },
            {
                path: "new",
                title: "Thêm Order",
                component: CreateOrderProduct,
                hidden: true,
            },
            {
                path: ":id",
                title: "Sửa liên hệ",
                hidden: true,
                component: EditOrderProduct,
            },
        ],
    },

    {
        path: "blog",
        title: "Tin tức",
        icon: <BookOutlined />,
        childs: [
            {
                title: "Quản lý bài viết",
                path: "post",
                component: BlogPostPage,
            },
            {
                path: "post/new",
                title: "Thêm bài viết",
                component: CreateBlogPostPage,
                hidden: true,
            },
            {
                path: "post/:id",
                title: "Sửa bài viết",
                hidden: true,
                component: EditBlogPostPage,
            },
        ],
    },
];

export default routes;
