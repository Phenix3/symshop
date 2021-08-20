<template>
  <SuiSegment basic :loading="loading">
    <div class="ui info icon message" v-if="items.length == 0">
      <i class="info icon"></i>
      <div class="content">
        <div class="header">Info</div>
        Votre panier est vide
      </div>
    </div>
    <SuiGrid v-else>
      <SuiGridColumn :computer="11" :mobile="16">
        <SuiTable celled striped>
          <SuiTableHeader>
            <SuiTableRow positive>
              <SuiTableHeaderCell>Image</SuiTableHeaderCell>
              <SuiTableHeaderCell>Product</SuiTableHeaderCell>
              <SuiTableHeaderCell>Price</SuiTableHeaderCell>
              <SuiTableHeaderCell>Quantity</SuiTableHeaderCell>
              <SuiTableHeaderCell>Total</SuiTableHeaderCell>
              <SuiTableHeaderCell>Actions</SuiTableHeaderCell>
            </SuiTableRow>
          </SuiTableHeader>
          <SuiTableBody>
            <CartItemRow
              v-for="item in items"
              :key="item.id"
              :item="item"
              @remove-cart-item="removeItem"
              @update-total="updateTotal"
            ></CartItemRow>
          </SuiTableBody>
          <!-- <SuiTableFooter>
            <SuiTableRow>
              <SuiTableCell colspan="3">Total TTC</SuiTableCell>
              <SuiTableCell colspan="2">{{ total }}</SuiTableCell>
            </SuiTableRow>
          </SuiTableFooter> -->
        </SuiTable>
      </SuiGridColumn>
      <SuiGridColumn :computer="5" :mobile="16">
        <SuiSegment>
          <SuiHeader dividing>Resume</SuiHeader>
          <SuiTable very basic>
            <SuiTableBody>
              <SuiTableRow>
                <SuiTableCell>Total</SuiTableCell>
                <SuiTableCell> {{ total }} </SuiTableCell>
              </SuiTableRow>
              <SuiTableRow>
                <SuiTableCell>Cout de livraison estime</SuiTableCell>
                <SuiTableCell> 0 </SuiTableCell>
              </SuiTableRow>
              <SuiTableRow>
                <SuiTableCell>Taxes total:</SuiTableCell>
                <SuiTableCell> {{ 0 }} </SuiTableCell>
              </SuiTableRow>
            </SuiTableBody>
          </SuiTable>
        </SuiSegment>
      </SuiGridColumn>
    </SuiGrid>
  </SuiSegment>
</template>

<script>
import CartItemRow from "./CartItemRow";

export default {
  components: {
    CartItemRow,
  },
  props: {},
  data() {
    return {
      items: [],
      total: 0,
      loading: false,
    };
  },
  methods: {
    fetchCartItems() {
      this.loading = true;
      axios
        .get("/cart")
        .then((response) => {
          console.log(response);
          this.items = response.data.cart;
          this.total = response.data.total;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
          this.loading = false;
        });
    },
    removeItem(event) {
      this.loading = true;
      axios
        .delete(`/cart/${event.id}/remove`)
        .then((response) => {
          console.log(response);
          this.items = response.data.cart;
          this.total = response.data.total;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
          this.loading = false;
        });
    },
    updateTotal({ oldSubTotal, newSubTotal }) {
      console.log(oldSubTotal, newSubTotal);
      this.total -= oldSubTotal;
      this.total += newSubTotal;
    },
  },
  created() {
    this.loading = true;
    this.fetchCartItems();
  },
};
</script>
