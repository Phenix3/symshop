<template>
     <SuiTableRow>
        <SuiTableCell>
          <SuiImage v-if="item.associatedModel.imagePaths.mini" :src="item.associatedModel.imagePaths.mini"></SuiImage>
        </SuiTableCell>
        <SuiTableCell>{{ item.name }}</SuiTableCell>
        <SuiTableCell class="subPrice">{{ item.price }}</SuiTableCell>
        <SuiTableCell>
          <SuiForm :loading="loading">
            <SuiFormField>
              <SuiInput type="number" v-model="quantity" min="1" @blur="updateQuantity"/>
            </SuiFormField>
          </SuiForm>
        </SuiTableCell>
        <SuiTableCell class="subTotal">{{ subTotal }}</SuiTableCell>
        <SuiTableCell>
          <a class="ui red icon button" @click="remove(item)" ><i class="trash icon"></i></a>
        </SuiTableCell>
    </SuiTableRow>
</template>

<script>

export default {
    props: ['item'],
    data() {
      return {
        quantity: 1,
        loading: false,
        subTotal: 0
      };
    },
    methods: {
      remove(item) {
        this.$emit('remove-cart-item', item);
      },
      updateQuantity() {
        this.loading = true;
        axios.post(`/cart/${this.item.id}/update`, {
          quantity: this.quantity
        })
          .then(response => {
            this.loading = false;
            console.log(response);
            // const quantity = this.item.quantity + this.quantity;
            const newSubTotal = (this.item.price * this.quantity);
            this.$emit('update-total', {oldSubTotal: this.subTotal, newSubTotal});
            this.subTotal = newSubTotal;
          })
          .catch(error => {
            this.loading = false;
            console.log(error);
          });
      }
    },
    mounted() {
      this.subTotal = this.item.price * this.item.quantity;
      this.quantity = this.item.quantity;
    }
}

</script>
