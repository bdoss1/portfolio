<template>
    <div>

        <div class="comments">
            <div class="comments-title"><h3>Комментарии ({{ itemsCount }})</h3></div>
            <div class="comment-form">
                <comment-form
                    parent-id="0"
                ></comment-form>
            </div>

            <comment-tree
                :items="items"
                depth="0"
            ></comment-tree>

        </div>
    </div>
</template>


<script>
    import CommentForm from './forms/comment';
    import CommentTree from './tree';
    import RouteMixin from './mixins/route';
    import bus from './bus';


    export default {
        name: "CommentComponent",
        props: ['model', 'model-id', 'prefix', 'is-user-logged'],
        components: {CommentForm, CommentTree},
        mixins: [RouteMixin],
        data() {
            return {
                items: [],
                itemsCount: 0
            };
        },
        created() {
            bus.$on('add-item', (values) => {
                this.addItem(values.parentId, values.item);
            });
        },
        mounted() {
            this.getItemsCount();
        },
        methods: {
            getItemsCount() {
                axios.post(this.route('count'), {
                    model: this.model,
                    model_id: this.modelId
                }).then(response => {
                    if (response.data.success) this.itemsCount = response.data.count;
                }).catch(error => {
                    console.log(error);
                });
            },
            addItem(parentId, item) {
                if (parentId == 0) {
                    this.items.unshift(item);
                } else {
                    insertItem(this.items);

                    function insertItem(array) {
                        for (let key in array) {
                            if (array[key].id == parentId) {
                                return array[key].children.unshift(item);
                            }
                            if (array[key].children.length > 0) {
                                insertItem(array[key].children);
                            }
                        }
                    }

                }
            }
        }
    }
</script>

<style scoped>
    .comments {
        margin: 30px 0;
    }

    .comments-title {
        margin-bottom: 15px;
    }


</style>
