<template>
    <p v-if="$page.props.flash.message"
       class="bg-indigo-600 h-10 flex items-center justify-center text-sm font-medium text-white px-4 sm:px-6 lg:px-8">
        {{ $page.props.flash.message }}
    </p>
    <div class="container mx-auto">
        <ul>
            <li>
                <Link :href="route('home')">
                    Home
                </Link>
            </li>

            <li>
                <Link :href="route('about')">
                    About us
                </Link>
            </li>

            <li>
                <Link :href="route('users.index')">
                    Users
                </Link>
            </li>
        </ul>

        <slot/>
    </div>

    <div v-if="$page.props.flash.user">
        {{ $page.props.flash.user.email }}

        <div>
            <button><a @click="logout">Выйти</a></button>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    name: "Layout",

    components: {
        Link
    },
    methods: {
        logout() {
            this.$inertia.delete(route('logout'))
        }
    }
}
</script>

