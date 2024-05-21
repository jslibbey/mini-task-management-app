<template>
<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Test</span>
        </a>
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            <a href="tel:5541251234" class="text-sm  text-gray-500 dark:text-white hover:underline">(555) 412-1234</a>
            <a href="/logout" class="text-sm  text-blue-600 dark:text-blue-500 hover:underline">Logout</a>
        </div>
    </div>
</nav>
<nav class="bg-gray-50 dark:bg-gray-700">
    <div class="max-w-screen-xl px-4 py-3 mx-auto">
        <div class="flex items-center">
            <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                <li>
                    <router-link to="/" class="text-gray-900 dark:text-white hover:underline">Home</router-link>
                </li>
                <li>
                    <router-link to="/users" class="text-gray-900 dark:text-white hover:underline">User</router-link>
                </li>
                <li>
                    <router-link to="/tasks" class="text-gray-900 dark:text-white hover:underline">Task</router-link>
                </li>
            </ul>
        </div>
    </div>
</nav>
</template>

<script setup>
</script>
