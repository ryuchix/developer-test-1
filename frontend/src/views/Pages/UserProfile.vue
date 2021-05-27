<template>
    <div class="flex items-center h-screen w-full justify-center">

    <div class="max-w-lg">
        <div class="bg-white shadow-xl rounded-lg py-3 relative">
            <div class="photo-wrapper p-2">
                <img class="w-32 h-32 rounded-full mx-auto" v-if="profile.profile != null && profile.profile.image != null" :src="profile.profile.image" alt="John Doe">
            </div>
            <div class="p-2">
                <h3 class="text-center text-xl text-gray-900 font-medium leading-8">{{ profile.name }}</h3>
                <table class="text-xs my-3">
                    <tbody>
                        <tr>
                            <td class="px-2 py-2 text-gray-500 font-semibold">Phone number</td>
                            <td class="px-2 py-2">{{ profile.profile != null ? profile.profile.phone : '' }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 text-gray-500 font-semibold">Mobile number</td>
                            <td class="px-2 py-2">{{ profile.profile != null ? profile.profile.mobile : '' }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 text-gray-500 font-semibold">Address</td>
                            <td class="px-2 py-2">{{ profile.profile != null ? profile.profile.address : '' }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 text-gray-500 font-semibold">City</td>
                            <td class="px-2 py-2">{{ profile.profile != null ? profile.profile.city : '' }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 text-gray-500 font-semibold">State</td>
                            <td class="px-2 py-2">{{ profile.profile != null ? profile.profile.state : '' }}</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 text-gray-500 font-semibold">Zip</td>
                            <td class="px-2 py-2">{{ profile.profile != null ? profile.profile.zip : '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "UserProfile",

  data() {
    return {
      success: null,
      error: null,
      isOpen: false,
    };
  },

  mounted() {
    this.getProfile(this.$route.params.userid)
  },

  computed: {
    ...mapGetters("auth", ["profile"])
  },

  methods: {
    ...mapActions("auth", ["getProfile"]),
  }
};
</script>