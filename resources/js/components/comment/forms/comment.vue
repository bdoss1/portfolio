<template>
    <div>
        <form @submit.prevent="store" class="comment-form">
            <div v-if="! isUserLogged" class="form-group">
                <input type="text" v-model="name" class="form-control" placeholder="Имя">
            </div>
            <div v-if="! isUserLogged" class="form-group">
                <input type="email" v-model="email" class="form-control" placeholder="E-mail">
            </div>
            <div class="form-group">
                <textarea class="form-control" v-model="message" rows="3"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </form>
    </div>
</template>


<script>
    import RouteMixin from './../mixins/route';
    import ValuesMixin from './../mixins/values';
    import bus from './../bus';

    export default {
        name: "CommentForm",
        props: ['parent-id', 'items', 'item'],
        mixins: [RouteMixin, ValuesMixin],
        data() {
            return {
                name: '',
                email: '',
                message: ''
            }
        },
        methods: {
            store() {
                axios.post(this.route('store'), {
                    name: this.name,
                    email: this.email,
                    message: this.message,
                    parent_id: this.parentId,
                    model: this.model,
                    model_id: this.modelId
                }).then(response => {
                    if (response.data.success) {
                        this.message = null;
                        bus.$emit('add-item', {
                            parentId: this.parentId,
                            item: response.data.comment
                        });
                    }
                }).catch(error => {

                });
            }
        }
    }
</script>

<style scoped>
    .comment-form {
        margin: 15px 0;
    }
</style>
