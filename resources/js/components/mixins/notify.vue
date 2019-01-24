<script>
    import LangMixin from './lang';

    export default {
        name: "notify",
        mixins: [LangMixin],
        methods: {
            notifySuccess(message) {
                return this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: this.portfolio.lang.custom.success,
                    text: message
                });
            },
            notifyError(message) {
                return this.$notify({
                    group: 'foo',
                    type: 'error',
                    title: this.portfolio.lang.custom.error,
                    text: message
                });
            },
            notifyAttention(message) {
                return this.$notify({
                    group: 'foo',
                    type: 'warn',
                    title: this.portfolio.lang.custom.attention,
                    text: message
                });
            }
        }
    }
</script>
