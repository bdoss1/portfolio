<script>
    import NotifyMixin from './../../mixins/notify';

    export default {
        name: "errors",
        mixins: [NotifyMixin],
        methods: {
            showErrorsOfValidation(errors) {
                for (let key in errors) {
                    return this.notifyError(errors[key][0]);
                }
            },
            showErrorOfTooManyAttempts() {
                return this.notifyError(this.lang.messages.dont_spam);
            },
            showNotApprovedError() {
                return this.notifyError(this.lang.messages.not_approved);
                // alert(this.lang.messages.not_approved);
            }
        }
    }
</script>

