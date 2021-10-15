import Home from "./pages/Home.vue";
import Products from "./pages/Products";
import Checkout from "./pages/Checkout";
import Register from "./pages/Register";

import Login from "./pages/Login";

export default [
    {
        path: "/",
        component: Home
    },
    {
        path: "/products",
        component: Products
    },
    {
        path: "/checkout",
        component: Checkout
    },
    {
        path: "/login",
        component: Login
    },
    {
        path: "/register",
        component: Register
    },
]

