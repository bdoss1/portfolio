<template>
    <div>
        <template v-for="item in items">
            <!-- a comment -->
            <div :class="{
              'comments-tree': true,
              'comments-tree_no_margin': depth > 3
            }">
                <div :data-depth="depth" :data-id="item.id" class="comment row top_15">
                    <div class="comment-content col-md-12">
                        <h3 class="title top_15">{{ item.user.name }}</h3>
                        <span class="date">{{ item.date }}</span>
                        <p>{{ item.message }}</p>
                        <a @click.prevent="toggleForm(item)" href="#" class="reply">
                            {{ lang.buttons.reply }}
                        </a>
                        <comment-form v-if="item.isVisibleForm" :parent-id="item.id"></comment-form>
                    </div>
                </div>

                <comment-item :items="item.children" :depth="parseInt(depth) + 1"></comment-item>
            </div>

        </template>
    </div>
</template>

<script>
    import CommentForm from './forms/comment'
    import ConfigMixin from './mixins/config';

    export default {
        name: "CommentItem",
        props: ['items', 'depth'],
        components: {CommentForm},
        mixins: [ConfigMixin],
        methods: {
            toggleForm(item) {
                item.isVisibleForm = !item.isVisibleForm;
            }
        }
    }
</script>

<style scoped>

    .comments-item {
        margin: 15px 0;
        border: 1px solid navajowhite;
        border-radius: 15px;
        padding: 15px;
    }

    .comments-avatar {
        width: 100px;
        height: 100px;
        border: 1px solid navajowhite;
        border-radius: 15px;
        padding: 15px;
    }

    .comments-group {
        padding-left: 15px;
    }

    .comment-message {
        margin: 10px 0;
    }

    .comments-tree .comments-tree {
        margin-left: 70px;
    }

    .comments-tree .comments-tree .comments-tree_no_margin {
        margin-left: 0;
    }

    .comment-error {
        color: red;
        font-size: 12px;
        margin: 10px 0;
    }
</style>
