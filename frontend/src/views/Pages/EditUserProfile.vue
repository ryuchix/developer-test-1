<template>
    <div class="flex justify-center p-20">

    <div class="max-w-max ">
        <div class="bg-white shadow-xl rounded-lg py-3 px-6 relative">
          <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
                <div class="mb-4">
                    <img class="mx-auto w-40 h-40 rounded-full object-cover object-center" v-if="profile.image != null" :src="profile.image" alt="Image Upload" />
                </div>
                <label class="cursor-pointer my-6 flex justify-center">
                    <span class="mt-2 leading-normal px-4 py-2 bg-blue-500 text-white text-sm rounded-full">Select Image</span>
                    <input type="file" accept="image/*" @change="onChange" class="hidden" name="image" />
                </label>

              <div class="flex flex-row space-x-5">
                <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                    Name
                </label>
                <input
                    v-model="user.name"
                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="name"
                    type="text" />
                </div>
                <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                    Email
                </label>
                <input
                    v-model="user.email"
                    readonly
                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="email"
                    type="email" />
                </div>

              </div>
              <div class="flex flex-row space-x-5">
                <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="phone">
                    Phone
                </label>
                <input
                    v-model="profile.phone"
                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="phone"
                    name="phone"
                    type="text" />
                </div>
                <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="mobile">
                    Mobile
                </label>
                <input
                    v-model="profile.mobile"
                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="mobile"
                    type="text" />
                </div>
              </div>
              <div class="flex flex-row space-x-5">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="address">
                        Address
                    </label>
                    <input
                        v-model="profile.address"
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="address"
                        type="text" />
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="city">
                        City
                    </label>
                    <input
                        v-model="user.profile.city"
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="city"
                        type="text" />
                </div>
              </div>
              <div class="flex flex-row space-x-5">
                <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="state">
                    State
                </label>
                <input
                    v-model="profile.state"
                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="state"
                    type="text" />
                </div>
                <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="zip">
                    Zip
                </label>
                <input
                    v-model="profile.zip"
                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="zip"
                    type="text" />
                </div>
              </div>

            <div class="mb-6 text-center">
              <button @click="update"
                class="w-full px-4 py-2 font-bold text-white bg-red-500 rounded-full hover:bg-red-700 focus:outline-none focus:shadow-outline"
                type="button">Update</button>
            </div>
            <hr class="mb-6 border-t" />
          </form>
        </div>
    </div>

    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import _ from 'lodash'
import axios from "axios";
import { constant } from "@/store/constant";

export default {
  name: "EditUserProfile",

  data() {
    return {
        success: null,
        error: null,
        isOpen: false,
        item: {
            image : null,
            imageUrl: null
        },
        profile: {
            user_id: null,
            phone: null,
            mobile: null,
            address: null,
            city: null,
            state: null,
            zip: null,
            image: null
        }
    };
  },

  mounted() {
    this.profile = this.user.profile;
    this.profile.id = this.$route.params.userid;
  },

  computed: {
    ...mapGetters("auth", ["user"])
  },

  methods: {
    ...mapActions("auth", ["getPosts", "updateUser"]),

    update() {
        this.updateUser(this.user).then(() => {
            this.updateProfile()
        });;
    },

    updateProfile() {
        let formData = new FormData()
        formData.append('image', this.item.image)
        _.each(this.profile, (value, key) => {
            formData.append(key, value)
        })
        axios.post(constant.url + 'update-profile/' + this.profile.id, formData, {
            headers: {
              'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
            }
          }
        )
    },

    onChange(e) {
      const file = e.target.files[0]
      this.item.image = file
      this.item.imageUrl = URL.createObjectURL(file)
      this.user.profile.image = URL.createObjectURL(file)
    }
  }
};
</script>