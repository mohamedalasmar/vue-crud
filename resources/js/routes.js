import Login from "./components/Login";
import Register from "./components/Register";
import Post from "./components/Post";

//Vue Router
const routes = [
    { path: "/login", component: Login },
    { path: "/register", component: Register },
    { path: "/post", component: Post }
];

export default routes
