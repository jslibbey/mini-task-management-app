<template>
  <div class="mx-auto max-w-screen-xl p-4">
    <div class="bg-white overflow-hidden shadow rounded-lg border">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-[32px] font-medium text-gray-900">
          {{ task?.name }}
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
          {{ task?.description }}
        </p>
      </div>
      <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <div class="flex justify-between py-3">
          <h2 class="py-3 px-5 text-[16px] font-bold">List Subtasks</h2>

          <button
            @click="openCreateModal = true"
            type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
          >
            Create Subtask
          </button>
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
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <!-- <th scope="col" class="px-6 py-3">
                  <span class="sr-only">Edit</span>
                </th> -->
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(item, idx) in task?.sub_tasks"
                :key="idx"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
              >
                <th
                  scope="row"
                  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >
                  {{ idx + 1 }}
                </th>
                <td class="px-6 py-4">
                  <router-link
                    :to="{ name: 'tasks.detail', params: { id: item?.id } }"
                    class="hover:text-blue-600 hover:underline"
                  >
                    {{ item?.name }}
                  </router-link>
                </td>
                <td class="px-6 py-4">{{ item?.status }}</td>
                <td class="px-6 py-4">{{ item?.description }}</td>
                <!-- <td class="px-6 py-4 flex gap-2 text-right">
                  <button
                    class="font-medium text-red-600 dark:text-blue-500 hover:underline"
                    @click="
                      () => {
                        openConfirmModal = true;
                        taskId = item?.id;
                      }
                    "
                  >
                    Delete
                  </button>
                </td> -->
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>


    <sub-task-create :close="closeCreateModal" :open="openCreateModal" :parent-id="taskId"/>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { showTask } from "@requests/task";
import { useRoute } from "vue-router";
import SubTaskCreate from "@components/SubTaskCreate.vue";


const route = useRoute();
const task = ref({});
const taskId = route.params.id;
const openCreateModal = ref(false);


const closeCreateModal = () => {
  openCreateModal.value = false;
  fetchTask(taskId);
};


const fetchTask = async (taskId) => {
  try {
    const result = await showTask(taskId);

    if (result) {
      task.value = result.data;
    }
  } catch (error) {
    console.log(error);
  }
};

onMounted(() => {
  fetchTask(taskId);
});
</script>
