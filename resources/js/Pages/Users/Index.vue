<template>
    <Head :title="title"/>
    <header class="bg-white shadow mb-10">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                {{ title }}
            </h1>
        </div>
    </header>

    <Link :href="route('users.create')" class="text-indigo-600 hover:text-indigo-900 my-5 block">
        Добавить пользователя
    </Link>


    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div v-if="users.data.length > 0" class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Имя
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Е-mail
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Image
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Действия</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="user in users.data" :key="user.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ user.name }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ user.email }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div v-for="img in user.image " class="text-sm font-medium text-gray-900">
                                    <img :src="`/storage/customer/${img}`" alt="" style="width: 50px;height: 50px">
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end items-center space-x-3">
                                <Link :href="route('users.edit',user.id)" class="text-indigo-600 hover:text-indigo-900">
                                    Редактировать
                                </Link>
                                <a @click="destroy(user.id)" class="text-red-600 hover:text-red-900 cursor-pointer">Удалить</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <Pagination :links="users.links"/>
                </div>

                <div v-else class="text-center font-bold text-xl">
                    Пользователей пока нет
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Head, Link } from "@inertiajs/vue3";

import Pagination from "../../Shared/Pagination.vue";

export default {
    name: "Home",
    components: {
        Head,
        Pagination,
        Link
    },
    props: {
        title: String,
        users: Array,
    },
    created() {
        console.log(this.users.links);
        console.log(this.users);
    },
    methods: {
        destroy(id) {
            if (confirm('Вы уверены?')) {
                this.$inertia.delete(this.route('users.destroy', id))
            }
        }
    }
}
</script>
