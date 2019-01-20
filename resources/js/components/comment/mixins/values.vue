<script>
    export default {
        name: "values",
        data() {
            return {
                model: '',
                modelId: '',
                prefix: '',
                isUserLogged: false
            }
        },
        mounted() {
            this.model = this.$parent.model;
            this.modelId = this.$parent.modelId;
            this.prefix = this.$parent.prefix;
            this.isUserLogged = this.$parent.isUserLogged;
        }
    }
</script>
