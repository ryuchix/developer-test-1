import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const guest = (to, from, next) => {
  if (!localStorage.getItem("authToken")) {
    return next();
  } else {
    return next("/");
  }
};
const auth = (to, from, next) => {
  if (localStorage.getItem("authToken")) {
    return next();
  } else {
    return next("/login");
  }
};

const routes = [
  {
    path: "/",
    name: "Home",
    beforeEnter: auth,
    component: () => import(/* webpackChunkName: "home" */ "../views/Home.vue")
  },
  {
    path: "/login",
    name: "Login",
    beforeEnter: guest,
    component: () =>
      import(/* webpackChunkName: "login" */ "../views/Auth/Login.vue")
  },
  {
    path: "/register",
    name: "Register",
    beforeEnter: guest,
    component: () =>
      import(/* webpackChunkName: "register" */ "../views/Auth/Register.vue")
  },
  {
    path: "/verify/:hash",
    name: "Verify",
    beforeEnter: auth,
    props: true,
    component: () =>
      import(/* webpackChunkName: "verify" */ "../views/Auth/Verify.vue")
  },
  {
    path: "/add-post",
    name: "AddPost",
    beforeEnter: auth,
    props: true,
    component: () =>
      import(/* webpackChunkName: "verify" */ "../views/Pages/AddPost.vue")
  },
  {
    path: "/edit-post/:postid",
    name: "EditPost",
    beforeEnter: auth,
    props: true,
    component: () =>
      import(/* webpackChunkName: "verify" */ "../views/Pages/EditPost.vue")
  },
  {
    path: "/view-post/:postid",
    name: "ViewPost",
    beforeEnter: auth,
    props: true,
    component: () =>
      import(/* webpackChunkName: "verify" */ "../views/Pages/ViewPost.vue")
  },
  {
    path: "/view-post/:postid/:commentid",
    name: "EditComment",
    beforeEnter: auth,
    props: true,
    component: () =>
      import(/* webpackChunkName: "verify" */ "../views/Pages/EditComment.vue")
  },
  {
    path: "/profile",
    name: "Profile",
    beforeEnter: auth,
    props: true,
    component: () =>
      import(/* webpackChunkName: "verify" */ "../views/Pages/Profile.vue")
  },
  {
    path: "/profile/:userid",
    name: "UserProfile",
    beforeEnter: auth,
    props: true,
    component: () =>
      import(/* webpackChunkName: "verify" */ "../views/Pages/UserProfile.vue")
  },
  {
    path: "/profile/:userid/edit",
    name: "EditUserProfile",
    beforeEnter: auth,
    props: true,
    component: () =>
      import(/* webpackChunkName: "verify" */ "../views/Pages/EditUserProfile.vue")
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
