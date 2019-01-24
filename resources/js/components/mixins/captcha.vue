<script>
    export default {
        name: "captcha",
        data() {
            return {
                sitekey: '',
                gRecaptchaResponse: ''
            };
        },
        created() {
            this.sitekey = window.Portfolio.captcha.sitekey;
        },
        methods: {
            onExpired: function () {
                this.gRecaptchaResponse = '';
            },
            resetRecaptcha() {
                this.$refs.invisibleRecaptcha.reset() // Direct call reset method
            }
        }
    }
</script>