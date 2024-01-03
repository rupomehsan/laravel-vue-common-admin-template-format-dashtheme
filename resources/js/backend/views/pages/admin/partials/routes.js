import Layout from "./Layout.vue"
import Dashboard from "../Dashboard.vue"

import blog_category_routes from "../management/BlogManagement/Category/setup/routes";
import blog_routes from "../management/BlogManagement/Blog/setup/routes";
import user_routes from "../management/user/setup/routes";
import newspaper_routes from "../management/NewsPaper/setup/routes";


const routes = {
    path: '/dashboard',
    component: Layout,
    children: [
        {
            path: '',
            component: Dashboard,
            name: 'adminDashboard',
        },

        blog_category_routes,
        blog_routes,
        user_routes,
        newspaper_routes,

    ]
};


export default routes;
