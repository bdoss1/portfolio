<template>
    <div class="vld-parent" ref="formContainer">
        <!-- LEAVE A COMMENT -->
        <div class="leave-reply top_30 bottom_45">
            <form @submit.prevent="checkByGoogleRecaptcha()" class="row">

                <vue-recaptcha
                        ref="invisibleRecaptcha"
                        @verify="onVerify"
                        @expired="onExpired"
                        size="invisible"
                        :sitekey="sitekey">
                </vue-recaptcha>

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
    import LoaderMixin from './../../mixins/loader';
    import CaptchaMixin from './../../mixins/captcha';


    import bus from './../bus';
    import VueRecaptcha from 'vue-recaptcha';


    export default {
        name: "CommentForm",
        props: ['parent-id'],
        mixins: [RouteMixin, ConfigMixin, ErrorMixin, LoaderMixin, CaptchaMixin],
        components: {VueRecaptcha},
        data() {
            return {
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
                    model_id: this.modelId,
                    locale: this.locale,
                    'g-recaptcha-response': this.gRecaptchaResponse
                }).then(response => {
                    this.loaderHide();

                    this.resetRecaptcha();

                    if (response.data.success) {
                        this.message = '';
                        bus.$emit('add-item', {
                            parentId: this.parentId,
                            item: response.data.comment
                        });

                        this.updateConfigAuthor(this.name, this.email);
                    }
                }).catch(error => {
                    this.loaderHide();

                    this.resetRecaptcha();

                    if (error.response.status === 422) this.showErrorsOfValidation(error.response.data.errors);

                    if (error.response.status === 429) this.showErrorOfTooManyAttempts();
                });

            },
            checkByGoogleRecaptcha() {
                this.loaderShow(this.$refs.formContainer);
                this.$refs.invisibleRecaptcha.execute();
            },
            onVerify: function (response) {
                this.gRecaptchaResponse = response;
                this.store();
            }
        }
    }
</script>

<style scoped>
    .comment-form {
        margin: 15px 0;
    }
</style>
