<template>
    <div>
        <h1>Hello Company!</h1>
    </div>
</template>
<script>
export default {
    name: 'Company-App-Index',
    data: function () {
        return {
            companies: [],
        };
    },
    mounted() {
        this.$store.dispatch('loadCompanies').then(companies => {
            console.log(companies);
            this.companies = companies;
        })
    }
};
</script>
