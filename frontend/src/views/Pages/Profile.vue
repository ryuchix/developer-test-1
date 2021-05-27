<template>
    <div class="flex items-center h-screen w-full justify-center">

    <div class="max-w-lg">
        <div class="bg-white shadow-xl rounded-lg py-3 relative">
            <div class="photo-wrapper p-2">
                <img class="w-32 h-32 rounded-full mx-auto" v-if="user.profile.image != null" :src="user.profile.image" alt="John Doe">
            </div>
            <div class="p-2">
                <h3 class="text-center text-xl text-gray-900 font-medium leading-8">{{ user.name }}</h3>
                <table class="text-xs my-3">
                    <tbody>
                        <tr>
                            <td class="px-2 py-2 text-gray-500 font-semibold">Phone number</td>
                            <td class="px-2 py-2">{{ user.profile.phone }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 text-gray-500 font-semibold">Mobile number</td>
                            <td class="px-2 py-2">{{ user.profile.mobile }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 text-gray-500 font-semibold">Address</td>
                            <td class="px-2 py-2">{{ user.profile.address }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 text-gray-500 font-semibold">City</td>
                            <td class="px-2 py-2">{{ user.profile.city }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 text-gray-500 font-semibold">State</td>
                            <td class="px-2 py-2">{{ user.profile.state }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 text-gray-500 font-semibold">Zip</td>
                            <td class="px-2 py-2">{{ user.profile.zip }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-center my-3">
                    <router-link :to="{ name: 'EditUserProfile', params: { userid: user.id }}" class="text-xs text-indigo-500 italic hover:underline hover:text-indigo-600 font-medium">Edit Profile</router-link>
                </div>

            </div>
        </div>
    </div>

    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Profile",

  data() {
    return {
      success: null,
      error: null,
      isOpen: false,
    };
  },

  mounted() {
    //
  },

  computed: {
    ...mapGetters("auth", ["user"])
  },

  methods: {
    ...mapActions("auth", ["getPosts", "removePost"]),

    addPost() {
      return this.$router.push({name: 'AddPost'});
    },

    editPost(id) {
      return this.$router.push({name: 'EditPost', params: {postid: id}});
    },

    deletePost(id) {
      this.removePost(id).then(() => this.getPosts());
    },

    viewPost(id) {
      return this.$router.push({name: 'ViewPost', params: {postid: id}});
    }
  }
};
</script>