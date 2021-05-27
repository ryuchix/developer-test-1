import axios from "axios";
import { constant } from "../store/constant";

export default {
  namespaced: true,

  state: {
    userData: null,
    posts: null,
    post: null,
    comment: null
  },

  getters: {
    user: state     => state.userData,
    posts: state    => state.posts,
    post: state     => state.post,
    comment: state  => state.comment
  },

  mutations: {
    setUserData(state, user) {
      state.userData = user;
    },
    setPosts(state, post) {
      state.posts = post;
    },
    setPost(state, post) {
      state.post = post;
    },
    setComment(state, comment) {
      state.comment = comment;
    }
  },

  actions: {
    // users
    getUserData({ commit }) {
      axios
        .get(constant.url + "user")
        .then(response => {
          commit("setUserData", response.data);
        })
        .catch(() => {
          localStorage.removeItem("authToken");
        });
    },
    sendLoginRequest({ commit }, data) {
      commit("setErrors", {}, { root: true });
      return axios
        .post(constant.url + "login", data)
        .then(response => {
          commit("setUserData", response.data.user);
          localStorage.setItem("authToken", response.data.token);
        });
    },
    sendRegisterRequest({ commit }, data) {
      commit("setErrors", {}, { root: true });
      return axios
        .post(constant.url + "register", data)
        .then(response => {
          commit("setUserData", response.data.user);
          localStorage.setItem("authToken", response.data.token);
        });
    },
    sendLogoutRequest({ commit }) {
      axios.post(constant.url + "logout").then(() => {
        commit("setUserData", null);
        localStorage.removeItem("authToken");
      });
    },
    sendVerifyResendRequest() {
      return axios.get(constant.url + "email/resend");
    },
    sendVerifyRequest({ dispatch }, hash) {
      return axios
        .get(constant.url + "email/verify/" + hash)
        .then(() => {
          dispatch("getUserData");
        });
    },
    // posts
    addPost({ commit }, data) {
      commit("setErrors", {}, { root: true });
      return axios.post(constant.url + "add-post", data)
    },
    getPosts({ commit }) {
      axios
        .get(constant.url + "posts")
        .then(response => {
          commit("setPosts", response.data);
        })
    },
    getPost({ commit }, id) {
      axios
        .get(constant.url + "post/" + id)
        .then(response => {
          commit("setPost", response.data);
        })
    },
    updatePost({ commit }, data) {
      commit("setErrors", {}, { root: true });
      return axios.post(constant.url + "update-post/" + data.id, data)
    },
    removePost({ commit }, data) {
      commit("setErrors", {}, { root: true });
      return axios.post(constant.url + "delete-post/" + data)
    },
    // comments
    addComment({ commit }, data) {
      commit("setErrors", {}, { root: true });
      return axios.post(constant.url + "add-comment", data)
    },
    updateComment({ commit }, data) {
      commit("setErrors", {}, { root: true });
      return axios.post(constant.url + "update-comment/" + data.id, data)
    },
    getComment({ commit }, id) {
      axios
        .get(constant.url + "comment/" + id)
        .then(response => {
          commit("setComment", response.data);
        })
    },
    removeComment({ commit }, data) {
      commit("setErrors", {}, { root: true });
      return axios.post(constant.url + "delete-comment/" + data)
    },
  }
};
