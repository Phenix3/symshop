<template>
    <SuiModal v-model="open" animation="fade" image size="tiny" @clickAwayModal="closeQuickView">
      <SuiModalHeader>
        {{ product.name }}
      </SuiModalHeader>
        <SuiImage :src="product.imagePaths.medium"></SuiImage>
      <SuiModalContent scrolling>
        <SuiModalDescription>
          {{ product.description }}
        </SuiModalDescription>
      </SuiModalContent>
      <SuiModalActions>
        <SuiButton color="black" @click="closeQuickView">Close</SuiButton>
        <SuiButton primary>Add to cart</SuiButton>
      </SuiModalActions>
    </SuiModal>
</template>

<script>
export default {
  data() {
    return {
      product: this.$root.productDetails,
      open: this.$root.quickView
    };
  },
  methods: {
    closeQuickView: function () {
      this.$root.quickView = false;
      this.$root.productDetails = [];
      // this.$parent.close();
      // console.log('CloseQuickView', this.$root.quickView);
      // $("body").toggleClass("overflow-hidden");
    },
  },
  computed: {
    'this.$root.quickView': () => this.open,
  },
  mounted() {
    // console.log('Product', this.product);
    // console.log('Open', this.open);
    // this.product = JSON.parse(this.quickViewDetails);
  },
  destroyed() {
    // console.log('Destroyed ProductQuickView');
    // console.log(this.$root.quickView);
  }
};
</script>
