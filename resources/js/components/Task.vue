<template>
  <div class="mx-auto max-w-screen-xl p-4">
    <div class="my-3">
      <button
        @click="openCreateModal = true"
        type="button"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
      >
        Create task
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
            <th scope="col" class="px-6 py-3">Description</th>
            <th scope="col" class="px-6 py-3">Status</th>
            <th scope="col" class="px-6 py-3">Assignee</th>
            <th scope="col" class="px-6 py-3">
              <span class="sr-only">Edit</span>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(task, idx) in taskList"
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
                :to="{ name: 'tasks.detail', params: { id: task?.id } }"
                class="hover:text-blue-600 underline"
              >
                {{ task?.name }}
              </router-link>
            </td>
            <td class="px-6 py-4">{{ task?.description }}</td>
            <td class="px-6 py-4">{{ task?.status }}</td>
            <td class="px-6 py-4">{{ task?.assignee?.name ?? "--" }}</td>
            <td class="px-6 py-4 flex gap-2 text-right">
              <button
                class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                @click="
                  () => {
                    openChangeStatusModal = true;
                    taskChosen = task;
                  }
                "
              >
                Edit
              </button>

              <button
                class="font-medium text-red-600 dark:text-blue-500 hover:underline"
                @click="
                  () => {
                    openConfirmModal = true;
                    taskChosen = task;
                  }
                "
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <task-create :close="closeCreateModal" :open="openCreateModal" />
  <change-status
    :close="closeChangeStatusModal"
    :open="openChangeStatusModal"
    :task="taskChosen"
  />
  <modal-confirm
    :close="closeConfirmModal"
    :open="openConfirmModal"
    :confirm="remove"
  />
</template>


<script setup>
import { ref, onMounted } from "vue";
import { getTasks, deleteTask } from "@requests/task";
import TaskCreate from "@components/TaskCreate.vue";
import ChangeStatus from "@components/modals/ChangeStatus.vue";
import ModalConfirm from "@components/modals/Confirm.vue";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();
const taskList = ref({});
const openCreateModal = ref(false);
const openConfirmModal = ref(false);
const openChangeStatusModal = ref(false);
const taskChosen = ref(null);

const closeCreateModal = () => {
  openCreateModal.value = false;
  fetchList();
};

const closeChangeStatusModal = () => {
  openChangeStatusModal.value = false;
  fetchList();
};

const closeConfirmModal = () => {
  openConfirmModal.value = false;
  fetchList();
};

// fetch list
const fetchList = async () => {
  try {
    const result = await getTasks();

    if (result) {
      taskList.value = result.data;
    }
  } catch (error) {
    console.log(error);
  }
};

const remove = async () => {
  try {
    const result = await deleteTask(taskChosen.value?.id);
    toast.success("Delete task successfully!", { position: "top-right" });
    closeConfirmModal();
  } catch (error) {
    console.log(error);
  }
};

onMounted(() => {
  fetchList();
});
</script>
