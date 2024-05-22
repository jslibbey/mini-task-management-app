<template>
  <section class="bg-gray-50 dark:bg-gray-900">
    <div
      class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0"
    >
      <a
        href="#"
        class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white"
      >
          Mini Task Management App
      </a>
      <div
        class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
      >
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1
            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
          >
            Sign up
          </h1>
          <form
            @submit.prevent="submit"
            class="space-y-4 md:space-y-6"
          >
            <div>
              <label
                for="email"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Your email</label
              >
              <input
                type="email"
                name="email"
                id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="test@company.com"
                required
                v-model="formData.email"
              />
            </div>
            <div>
              <label
                for="password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Password</label
              >
              <input
                type="password"
                name="password"
                id="password"
                placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required
                v-model="formData.password"
              />
            </div>
            <div>
              <label
                for="repeat_password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Repeat Password</label
              >
              <input
                type="password"
                name="repeat_password"
                id="repeat_password"
                placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required
                v-model="formData.repeat_password"
              />
            </div>
            <button
              type="submit"
              class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
            >
              Register
            </button>

            <div v-if="errorMessage" class="my-2 text-red-500 text-sm">
              {{ errorMessage }}
            </div>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
              You already have an account?
              <a
                href="/login"
                class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                >Sign in</a
              >
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>

  <toast-notify :type="'success'" />
</template>


  <script setup>
import { ref } from "vue";
import { register } from "@requests/auth";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const formData = ref({});
const errorMessage = ref("");
const toast = useToast();

const submit = async ({ parseServerError }) => {
  try {
    if (formData.value?.password == formData.value?.repeat_password) {
      const result = await register(formData.value);

      if (result && result.success) {
        toast.success("User created successfully!", { position: "top-right" });
        setTimeout(() => {
            location.href = "/login";
        }, 1500)
      }
    } else {
      errorMessage.value = "Password and Repeat password does not match";
    }
  } catch (error) {
    console.log(error);
    errorMessage.value = error?.customMessage || parseServerError(error);
  }
};
</script>
