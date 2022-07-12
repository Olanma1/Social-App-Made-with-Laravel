<template>
    <div class="flex flex-col flex-1 h-screen overflow-y-hidden">
        <Nav />

        <div class="flex overflow-y-hidden flex-1">
            <Sidebar />

            <div class="overflow-x-hidden w-2/3">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script type="module">
import Nav from "./Nav";
import Sidebar from "./Sidebar";

import { mapGetters } from "vuex";
export default {
    name: "App",
    components: {
        Nav,
        Sidebar,
    },
    mount() {
        this.$store.dispatch("fetchAuthUser");
    },
    create() {
        this.$store.dispatch("setPageTitle", this.$route.meta.title);
    },
    computed: {
        ...mapGetters({
            authUser: "authUser",
        }),
    },
    watch: {
        $route(to, from) {
            this.$store.dispatch("setPageTitle", to.meta.title);
        },
    },
};
</script>

<style scoped></style>
