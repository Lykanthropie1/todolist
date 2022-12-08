<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    name: "Tasks",
    components: {
        Head,
        AuthenticatedLayout
    },
    data() {
        return {
            title: '',
            content: '',
        }
    },
    methods: {
        store() {
            this.$inertia.post('/tasks/store', {title: this.title, content: this.content});
            this.title = '';
            this.content = '';
        },
        deleteTask(id) {
            this.$inertia.delete(`/tasks/${id}`)
        }
    },
    props: [
        'tasks',
        'errors'
    ]
}
</script>

<template>
    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tasks</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-96 text-center mx-auto">
                    <div class="w-96 mx-auto">
                        <h1 class="mt-2">Create task</h1>
                        <form @submit.prevent="store">
                            <div class="mt-2 mb-2 mx-auto">
                                <input v-model="title" class="border-gray-400 rounded-md" type="text" placeholder="title">
                                <p v-if="errors.title" class="text-rose-500">{{ errors.title }}</p>
                            </div>
                            <div class="mb-2 mx-auto">
                                <textarea v-model="content" class="w-80 rounded-md border-gray-400" placeholder="content"></textarea>
                                <p v-if="errors.content" class="text-rose-500">{{ errors.content }}</p>
                            </div>
                            <button class="hover:bg-cyan-500 block p-2 w-64 mx-auto bg-cyan-600 rounded-full mx-auto text-white mb-2" type="submit">Store</button>
                        </form>
                        <div v-if="tasks">
                            <div class="mt-8 pt-8 pb-8 border-t border-gray-200" v-for="task in tasks">
                                <div>{{ task.title }}</div>
                                <div>{{ task.content }}</div>
                                <div class="text-sm text-gray-400 text-right pr-8 mt-10">{{ task.date }}</div>
                                <button @click="deleteTask(task.id)" class="inline-flex px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
