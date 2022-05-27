import Home from "./pages/Home";
// import Products from "./pages/Products";
import Checkout from "./pages/Checkout";
import Register from "./pages/Register";
import OrdersStatus from "./pages/ordersStatus";
import ProductView from "./pages/ProductView";

import Login from "./pages/Login";
// import ProductView from "./pages/ProductView";

export default [
    {
        path: "/",
        component: Home
    },
    // {
    //     path: "/products",
    //     component: Products
    // },
    {
        path: "/checkout",
        component: Checkout
    },
    {
        // add id to get product page
        path: "/product/:id",
        component: ProductView,
    },
    {
        path: "/login",
        component: Login
    },
    {
        path: "/register",
        component: Register
    },
    {
        path: "/orders",
        component: OrdersStatus
    },
]

