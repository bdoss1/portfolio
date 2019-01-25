<template>
    <div class="vld-parent" ref="contactFormContainer">
        <form @submit.prevent="checkByGoogleRecaptcha()" class="row">
            <vue-recaptcha
                    ref="invisibleRecaptcha"
                    @verify="onVerify"
                    @expired="onExpired"
                    size="invisible"
                    :sitekey="sitekey">
            </vue-recaptcha>
            <div v-if="! isUserLogged" class="col-md-6">
                <input class="inp" v-model="name" type="text" :placeholder="portfolio.lang.attributes.name">
            </div>
            <div v-if="! isUserLogged" class="col-md-6">
                <input class="inp" v-model="email" type="email" :placeholder="portfolio.lang.attributes.email">
            </div>
            <div class="col-md-12">
                <textarea :placeholder="portfolio.lang.attributes.message" v-model="message" rows="6"
                          class="col-md-12 form-message"></textarea>
            </div>
            <div class="col-md-12 text-center">
                <input type="submit" :value="portfolio.lang.custom.send" class="site-btn2">
            </div>
        </form>
    </div>
</template>

<script>
    import LoaderMixin from './mixins/loader';
    import CaptchaMixin from './mixins/captcha';
    import LangMixin from './mixins/lang';
    import NotifyMixin from './mixins/notify';
    import VueRecaptcha from 'vue-recaptcha';


    export default {
        name: "ContactFormComponent",
        mixins: [CaptchaMixin, LoaderMixin, LangMixin, NotifyMixin],
        components: {VueRecaptcha},
        props: ['route', 'is-user-logged'],
        data() {
            return {
                name: '',
                email: '',
                message: ''
            };
        },
        methods: {
            sendForm() {
                axios.post(this.route, {
                    name: this.name,
                    email: this.email,
                    message: this.message
                }).then(response => {
                    this.loaderHide();

                    this.resetRecaptcha();

                    if (response.data.success) {
                        this.message = '';

                        this.notifySuccess(this.portfolio.lang.messages.form_sent);
                    }

                }).catch(error => {
                    this.loaderHide();

                    this.resetRecaptcha();

                    if (error.response.status === 422) return this.showErrorsOfValidation(error.response.data.errors);

                    if (error.response.status === 429) return this.showErrorOfTooManyAttempts();

                    return this.notifyError(error.response.data);
                });
            },
            checkByGoogleRecaptcha() {
                this.loaderShow(this.$refs.contactFormContainer);
                this.$refs.invisibleRecaptcha.execute();
            },
            onVerify: function (response) {
                this.gRecaptchaResponse = response;
                this.sendForm();
            },
            showErrorsOfValidation(errors) {
                for (let key in errors) {
                    return this.notifyError(errors[key][0]);
                }
            },
            showErrorOfTooManyAttempts() {
                return this.notifyError(this.portfolio.lang.messages.dont_spam);
            },
        }
    }
</script>

<style scoped>

</style>