<script>
    export default {
        data() {
            return {
                loader: ''
            }
        },
        methods: {
            loaderShow(ref) {
                this.loader = this.$loading.show({
                    container: ref,
                    canCancel: false
                });
            },
            loaderHide() {
                setTimeout(() => {
                    this.loader.hide();
                }, 200)
            }
        }
    }
</script>