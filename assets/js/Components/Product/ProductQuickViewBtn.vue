<template>
    <SuiButton primary @click="openQuickView">
      <SuiIcon name="zoom in" />
    </SuiButton>
</template>

<script>

export default {
    props: ['quickViewDetails'],
    data() {
        return {
            open: false
        };
    },
    methods: {
        openQuickView(event) {
            event.preventDefault();
            // event.stopPropagation();
            this.open = true;
            this.$root.productDetails = JSON.parse(this.quickViewDetails);
            this.$root.quickView = true;
            // console.log(this.$root.productDetails);
            // console.log(this.$root.quickView);
        }
    }
}
</script>
