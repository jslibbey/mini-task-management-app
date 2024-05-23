<template>
    <Teleport to="body">
        <div v-if="open" class="modal-overlay">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-xl dark:bg-gray-700">
                    <form @submit.prevent="submit">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
                        >
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Update Status
                            </h3>
                            <button
                                type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                @click="closeFn"
                            >
                                <svg
                                    class="w-3 h-3"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 14 14"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                                    />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <div class="mb-5">
                                <label
                                    for="status"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Select a status</label
                                >
                                <select
                                    id="status"
                                    name="status"
                                    v-model="formData.status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                    <option value="todo">Todo</option>
                                    <option value="inprogress">In-progress</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label
                                    for="assignee"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Select an assignee</label
                                >
                                <select
                                    id="assignee"
                                    name="assignee_id"
                                    v-model="formData.assignee_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                    <option value="">None</option>
                                    <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                                </select>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600"
                        >
                            <button
                                @click="closeFn"
                                type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            >
                                Close
                            </button>
                            <button
                                data-modal-hide="default-modal"
                                type="submit"
                                class="py-2.5 px-5 ms-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Teleport>
</template>

<script setup>
import { ref, onMounted, defineProps } from "vue";
import { updateTask } from "@requests/task";
import { getUsers } from "@requests/user";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const props = defineProps({
    open: { type: Boolean, default: false },
    close: { type: Function },
    task: { type: Object },
});

const toast = useToast();
const formData = ref({
    status: props.task?.status || '',
    assignee_id: props.task?.assignee_id || ''
});
const users = ref([]);

const closeFn = () => props?.close();

const fetchUsers = async () => {
    try {
        const response = await getUsers();
        if (response && response.data) {
            users.value = response.data;
        }
    } catch (error) {
        console.error("Error fetching users:", error);
        toast.error("Failed to load users", { position: "top-right" });
    }
};

onMounted(fetchUsers);

const submit = async () => {
    try {
        const result = await updateTask(parseInt(props.task?.id), formData.value);
        if (result && result.data) {
            formData.value = { status: '', assignee_id: '' };
            toast.success("Updated successfully!", { position: "top-right" });
            props?.close();
        }
    } catch (error) {
        if (error.response && error.response.data.message) {
            toast.error(error.response.data.message, { position: "top-right" });
        }
        console.log(error.response);
    }
};
</script>

<style>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000; /* Ensure it's on top of other content */
}
</style>
