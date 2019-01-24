<template>

</template>

<script>
    export default {
        data() {
            return {
                portfolio: {
                    lang: ''
                }
            }
        },
        created() {
            this.portfolio.lang = window.Portfolio.lang;
        }
    }
</script>

<style scoped>

</style>