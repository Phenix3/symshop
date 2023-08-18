
// CSS files imports
import "./scss/app.scss";

// start the Stimulus application
import "./bootstrap";

/*

// Vue.js Section
import Vue from "vue";
import SuiVue from "semantic-ui-vue";

// Cart Components
Vue.component(
  "cart-item-row",
  require("./js/Components/Cart/CartItemRow.vue").default
);
Vue.component(
  "cart-table",
  require("./js/Components/Cart/CartTable.vue").default
);
// Products Components
Vue.component(
  "product-quick-view-btn",
  require("./js/Components/Product/ProductQuickViewBtn.vue").default
);
Vue.component(
  "product-quick-view",
  require("./js/Components/Product/ProductQuickView.vue").default
);

// Vue.component('order-create', require('./js/Components/Order/OrderCreate.vue').default);

Vue.use(SuiVue);

const vm = new Vue({
  el: "#app",
  data() {
    return {
      quickView: false,
      productDetails: [],
    };
  },
});
*/

// Import plugins

import "./dist/semantic.min";
import "./js/plugins/toggle";
import "./js/plugins/address-book";
import "./js/plugins/cart-button";


// App Initialization

$("form.loadable").on("submit", (event) => {
  $(event.currentTarget)
    .addClass("loading");
});

$("form.loadable button[type=submit]").on("click", (event) => {
  $(event.currentTarget)
    .closest("form")
    .addClass("loading");
});
$(".loadable.button").on("click", (event) => {
  $(event.currentTarget).addClass("loading");
});
$(".message .close").on("click", (event) => {
  $(event.currentTarget)
    .closest(".message")
    .transition("fade");
});

$(".popup-js").popup();

$(".cart.button").popup({
  popup: $(".cart.popup"),
  on: "click",
});

$(".ui.checkbox").checkbox();
$(".ui.dropdown").dropdown();
$(".ui.menu .dropdown").dropdown({ action: "hide" });
$(".ui.inline.dropdown").dropdown();
$(".link.ui.dropdown").dropdown({ action: "hide" });
$(".button.ui.dropdown").dropdown({ action: "hide" });
$(".ui.fluid.search.selection.dropdown").dropdown();
$(".ui.accordion").accordion();
$("[data-toggles]").toggleElement();

$("#shipping-address").addressBook();
$("#billing-address").addressBook();

$("body")
  .find('input[autocomplete="off"]')
  .prop("autocomplete", "disable");

$('.ui.rating').rating();

$('.ui.comment.review .ui.rating').rating('disable');


