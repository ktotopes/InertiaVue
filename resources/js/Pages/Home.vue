<template>
    <Head :title="title"/>
<!--    <Head>-->
<!--        <title>{{title}}</title>-->
<!--    </Head>-->
    <h1>{{ title }}</h1>
</template>

<script>

import {Head} from "@inertiajs/vue3";

export default {
    name: "Home",
    // components: { 1 вариант с тегом <Layout>
    //     Layout
    // },
    components:{
      Head
    },
    props: {
        title: String
    },
    // layout:Layout, 2 вариант подключение лейоута
}
</script>
