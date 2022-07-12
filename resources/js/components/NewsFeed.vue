<template>
    <div class="flex flex-col items-center py-4">
        <NewPost></NewPost>

        <p v-if="newsStatus.postsStatus === 'loading'">Loading posts...</p>

        <Post
            v-for="(post, postKey) in posts.data"
            :key="postKey"
            :post="post"
        />
    </div>
</template>

<script>
import NewPost from "../views/NewPost.vue";
import Post from "../components/Post.vue";
import axios from "axios";
import { mapGetters } from "vuex";

export default {
    name: "NewsFeed",
    components: {
        NewPost,
        Post,
    },

    computed: {
        ...mapGetters({
            posts: "posts",
            newsStatus: "newsStatus",
        }),
    },

    created() {
        this.$store.dispatch("fetchNewsPosts");
    },
};
</script>

<style scoped></style>
