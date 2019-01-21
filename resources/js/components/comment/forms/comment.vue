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

    import bus from './../bus';

    export default {
        name: "CommentForm",
        props: ['parent-id', 'isUserLogged'],
        data() {
            return {
                name: '',
                email: '',
                message: ''
            }
        },
        methods: {
            store() {
                bus.$emit('store-item', {
                    parentId: this.parentId,
                    form: {
                        message: this.message,
                        name: this.name,
                        email: this.email,
                    }
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
