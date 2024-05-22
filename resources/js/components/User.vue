<template>
  <div class="mx-auto max-w-screen-xl p-4">
    <div class="my-3">
      <router-link to="user/create">
        <button
          type="button"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        >
          Create user
        </button>
      </router-link>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table
        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
      >
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">#</th>
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">Email</th>
            <th scope="col" class="px-6 py-3">Verified at</th>
            <th scope="col" class="px-6 py-3">
              <span class="sr-only">Edit</span>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(user, idx) in userList"
            :key="idx"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
          >
            <th
              scope="row"
              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
            >
              {{ idx + 1 }}
            </th>
            <td class="px-6 py-4">{{ user?.name }}</td>
            <td class="px-6 py-4">{{ user?.email }}</td>
            <td class="px-6 py-4">{{ user?.email_verified_at }}</td>
            <td class="px-6 py-4 flex gap-2 text-right">
              <button
                class="font-medium text-red-600 dark:text-blue-500 hover:underline"
                @click="() => {
                  openConfirmModal = true;
                  userId = user?.id
                }"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
    <modal-confirm :close="closeConfirmModal" :open="openConfirmModal" :confirm="remove" />
</template>


<script setup>
import { ref, onMounted } from "vue";
import { getUsers, deleteUser } from "@requests/user";
import ModalConfirm from "@components/modals/Confirm.vue";
import {useToast} from "vue-toast-notification";

const toast = useToast()
const userList = ref({});
const openConfirmModal = ref(null)
const userId = ref(null)

const closeConfirmModal = () => {
  openConfirmModal.value = false
  fetchUsers()
}
// fetch user
const fetchUsers = async () => {
  try {
    const result = await getUsers();

    if (result) {
      userList.value = result.data;
    }
  } catch (error) {
    console.log(error);
  }
};

const remove = async () => {
  try {
    await deleteUser(userId.value);
    toast.success("User deleted successfully!", { position: "top-right" });
    closeConfirmModal()
    fetchUsers()
  } catch (error) {
    console.log(error);
  }
};

onMounted(() => {
  fetchUsers();
});
</script>
