import Home from "./components/Home";
import Profile from "./components/Profile";
import Users from "./components/Users";
import Categories from "./components/Categories";
import Projects from "./components/Projects";
import Manual from "./components/Manual";
import Project from "./components/Project";
import Cabinets from "./components/Cabinets";
import Cabinet from "./components/Cabinet";
import Materials from "./components/Materials";
import Developer from "./components/Developer";
import NotFound from "./components/NotFound";
import Shop from "./components/Shop";
import ShopCabinet from "./components/ShopCabinet";

export default {
    mode: "history",
    routes: [
        { path: "/home", component: Home },
        { path: "/profile", component: Profile },
        { path: "/users", component: Users },
        { path: "/categories", component: Categories },
        { path: "/projects", component: Projects },
        { path: "/manual", component: Manual },
        { path: "/projects/:id", component: Project },
        { path: "/cabinets", component: Cabinets },
        { path: "/cabinet/:id", component: Cabinet },
        { path: "/materials", component: Materials },
        { path: "/developer", component: Developer },
        { path: "/shop", component: Shop },
        { path: "/shop/:slug", component: ShopCabinet },
        { path: "*", component: NotFound }
    ]
};
