<script>
    export default {
        name: "errors",
        methods: {
            showErrorsOfValidation(errors) {
                for (let key in errors) {
                    return this.$notify({
                        group: 'foo',
                        type: 'error',
                        title: this.lang.alerts.error,
                        text: errors[key][0]
                    });
                }

            },
            showErrorOfTooManyAttempts() {
                this.$notify({
                    group: 'foo',
                    type: 'error',
                    title: this.lang.alerts.error,
                    text: this.lang.messages.dont_spam
                });
            },
            showNotApprovedError() {
                this.$notify({
                    group: 'foo',
                    type: 'error',
                    title: this.lang.alerts.attention,
                    text: this.lang.messages.not_approved
                });
                // alert(this.lang.messages.not_approved);
            }
        }
    }
</script>

