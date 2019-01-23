<template>
    <div class="vld-parent" ref="formContainer">
        <!-- LEAVE A COMMENT -->
        <div class="leave-reply top_30 bottom_45">
            <form @submit.prevent="store" class="row">
                <div v-if="! isUserLogged" class="col-md-6">
                    <input class="inp" type="text" v-model="name" :placeholder="lang.labels.name">
                </div>
                <div v-if="! isUserLogged" class="col-md-6">
                    <input class="inp" type="email" v-model="email" :placeholder="lang.labels.email">
                </div>
                <div class="col-md-12">
                    <textarea :placeholder="lang.labels.message" v-model="message" rows="4"
                              class="col-md-12 form-message"></textarea>
                </div>
                <div class="col-md-12">
                    <input type="submit" :value="lang.buttons.send" class="site-btn2">
                </div>
            </form>
        </div>
    </div>
</template>


<script>
    import RouteMixin from './../mixins/route';
    import ConfigMixin from './../mixins/config';
    import ErrorMixin from './../mixins/error';
    import bus from './../bus';

    export default {
        name: "CommentForm",
        props: ['parent-id'],
        mixins: [RouteMixin, ConfigMixin, ErrorMixin],
        data() {
            return {
                message: ''
            }
        },
        methods: {
            store() {

                let loader = this.$loading.show({
                    container: this.$refs.formContainer,
                    canCancel: false
                });

                // console.log(this.model, this.modelId, this.parentId, this.prefix, this.isUserLogged);
                axios.post(this.route('store'), {
                    name: this.name,
                    email: this.email,
                    message: this.message,
                    parent_id: this.parentId,
                    model: this.model,
                    model_id: this.modelId,
                    locale: this.locale
                }).then(response => {
                    this.loaderHide(loader);

                    if (response.data.success) {
                        this.message = '';
                        bus.$emit('add-item', {
                            parentId: this.parentId,
                            item: response.data.comment
                        });

                        this.updateConfigAuthor(this.name, this.email);
                    }
                }).catch(error => {
                    this.loaderHide(loader);

                    if (error.response.status === 422) this.showErrorsOfValidation(error.response.data.errors)

                    if (error.response.status === 429) this.showErrorOfTooManyAttempts();
                });

            },
            loaderHide(loader) {
                setTimeout(() => {
                    loader.hide();
                }, 200)
            }
        }
    }
</script>

<style scoped>
    .comment-form {
        margin: 15px 0;
    }
</style>
