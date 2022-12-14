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
        title: "T???ng quan",
        icon: <DashboardOutlined />,
        component: Dashboard,
    },
    {
        path: "report",
        title: "B??o c??o",
        icon: <PieChartOutlined />,
        childs: [
            {
                title: "B??o c??o doanh thu",
                path: "revenue",
                component: ReportRevenue,
            },
            {
                path: "customer",
                title: "B??o c??o kh??ch h??ng",
                component: ReportCustomer,
            },
            // {
            //     path: "product",
            //     title: "B??o c??o s??ch",
            //     component: ReportProduct,
            // },
        ],
    },
    {
        path: "customer",
        title: "Kh??ch h??ng",
        icon: <UsergroupAddOutlined />,
        childs: [
            {
                title: "Qu???n l?? kh??ch h??ng",
                path: "",
                component: CustomerPage,
            },
            {
                path: "new",
                title: "Th??m kh??ch h??ng",
                component: CreatCustomerPage,
                hidden: true,
            },
            {
                path: ":id",
                title: "S???a kh??ch h??ng",
                hidden: true,
                component: EditCustomerPage,
            },
        ],
    },

    {
        path: "products",
        title: "s??ch",
        icon: <SkinOutlined />,
        childs: [
            {
                title: "Qu???n l?? th??? lo???i s??ch",
                path: "category",
                component: ProductCategoryPage,
            },
            {
                path: "category-product/new",
                title: "Th??m th??? lo???i s??ch",
                component: CreateProductsCategoryPage,
                hidden: true,
            },
            {
                path: "category-product/:id",
                title: "S???a th??? lo???i s??ch",
                hidden: true,
                component: EditProductsCategoryPage,
            },
            {
                title: "Qu???n l?? t??c gi???",
                path: "author",
                component: AuthorPage,
            },
            {
                path: "author/new",
                title: "Th??m t??c gi???",
                component: CreateAuthorPage,
                hidden: true,
            },
            {
                path: "author/:id",
                title: "S???a t??c gi???",
                hidden: true,
                component: EditAuthorPage,
            },
            {
                title: "Qu???n l?? nh?? xu???t b???n",
                path: "publisher",
                component: PublisherPage,
            },
            {
                path: "publisher/new",
                title: "Th??m t??c gi???",
                component: CreatePublisherPage,
                hidden: true,
            },
            {
                path: "publisher/:id",
                title: "S???a t??c gi???",
                hidden: true,
                component: EditPublisherPage,
            },
            {
                title: "Qu???n l?? s??ch",
                path: "product",
                component: ProductPage,
            },
            {
                path: "product/new",
                title: "Th??m s??ch",
                component: CreateProductPage,
                hidden: true,
            },
            {
                path: "product/:id",
                title: "S???a s??ch",
                hidden: true,
                component: EditProductPage,
            },

            {
                title: "Qu???n l?? t???n kho",
                path: "ware-house",
                component: WareHousePage,
            },
            {
                path: "ware-house/new",
                title: "Th??m t???n kho",
                component: CreateWareHousePage,
                hidden: true,
            },
            {
                path: "ware-house/:id",
                title: "S???a t???n kho",
                hidden: true,
                component: EditWareHousePage,
            },
        ],
    },
    {
        path: "order",
        title: "????n h??ng",
        icon: <ShoppingCartOutlined />,
        childs: [
            {
                title: "Qu???n l?? ????n h??ng",
                path: "",
                component: OrderProduct,
            },
            {
                path: "new",
                title: "Th??m Order",
                component: CreateOrderProduct,
                hidden: true,
            },
            {
                path: ":id",
                title: "S???a li??n h???",
                hidden: true,
                component: EditOrderProduct,
            },
        ],
    },

    {
        path: "blog",
        title: "Tin t???c",
        icon: <BookOutlined />,
        childs: [
            {
                title: "Qu???n l?? b??i vi???t",
                path: "post",
                component: BlogPostPage,
            },
            {
                path: "post/new",
                title: "Th??m b??i vi???t",
                component: CreateBlogPostPage,
                hidden: true,
            },
            {
                path: "post/:id",
                title: "S???a b??i vi???t",
                hidden: true,
                component: EditBlogPostPage,
            },
        ],
    },
];

export default routes;
