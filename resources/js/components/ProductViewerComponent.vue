<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8 alert alert-success" v-if="postSuccess">
                <p class="m-0">The purchase was made successfully</p>
            </div>
            <div class="col-md-8 alert alert-danger" v-if="postError">
                <p class="m-0">The purchase failed, please try again. {{ this.postErrorMessage }}</p>
            </div>
        </div>
        <div class="row justify-content-center product-page-view">
            <div class="col-md-4 product-photo">
                <template v-if="this.hasPhoto">
                    <img :src="product.photo_path" class="img-responsive">
                </template>
                <template v-else>
                    <img src="//satyr.io/400x400/eeeeee/ffffff&text=Product" class="img-responsive">
                </template>
            </div>

            <div class="col-md-5" style="border:0px solid gray">
                <h3>{{ product.name }}</h3>    

                <h5 class="product-quantity-stock">
                    <small>{{ product.stock_text }}</small>
                </h5>

                <h6 class="title-price text-uppercase mt-3">
                    <small>Cost</small>
                </h6>
                <h3>${{ product.cost | toCurrency }}</h3>
        
                <div class="mb-3 mt-3" v-if="this.isProductAvailable">
                    <h6 class="title-quantity text-uppercase">
                        <small>Quantity</small>
                    </h6>
                    
                    <quantity :max-quantity="product.quantity" ref="qty"></quantity>
                </div>
            
                <template v-if="this.isProductAvailable">
                    <button @click="handleSubmit" class="btn btn-success text-uppercase btn-block mb-3">Purchase</button>
                    <a :href="product.routes.layaway" class="btn btn-outline-primary btn-sm">Put on Layaway</a>
                </template>
                <template v-else>
                    <button class="btn btn-danger btn-disabled text-uppercase">Out Of Stock</button>
                </template>                       
            </div>                              

            <div class="col-md-9">
                <ul class="product-menu-items">
                    <li class="active">Description</li>
                    <li>Specifications</li>
                </ul>
                <div class="product-details-container">
                    <p>{{ product.description }}</p>
                </div>
            </div>		
        </div>
    </div>
</template>

<script>
    import Quantity from '../components/QuantityComponent.vue';

    export default {
        components: {
            Quantity
        },

        props: {
            action: {
                type: String
            },
            product: {
                type: Object
            }
        },

        data() {
            return {
                postSuccess: false,
                postError: false,
                postErrorMessage: null,
                qualtity: this.$refs.qty
            };
        },

        methods: {

            // Handle the submit in this example..
            // Typically we'd submit using Axios but in this case I wanted to use a native browser submit
            // For simplicity
            handleSubmit() {
                // Reset the states
                this.postSuccess = false;
                this.postError = false;
                this.postErrorMessage = null;

                // Build the form
                let formData = new FormData();
                formData.append('quantity', this.$refs.qty.quantity);
                
                // Submit the form
                axios.post(this.action, formData)
                    .then((response) => {
                        if (response.status == '200') {
                            this.postSuccess = true;

                            // Update the qty on the view
                            this.product.stock_text = response.data.stock_text;

                            // Update the quantity
                            this.product.quantity = response.data.quantity;
                            this.$refs.qty.maxQuantity = response.data.quantity;
                        } else {
                            this.postError = true;
                        }
                    })
                    .catch(error => { 
                        if (error.response.status == '401') {
                            window.location.href = '/login';
                        } else if (error.response.status == '400') {
                            this.postError = true;
                            this.postErrorMessage = error.response.data;
                        } else {
                            this.postError = true;
                            console.error(error);
                            throw error;
                        }
                    });

            },

            // Quick helper to format the price
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },

        },

        computed: {

            hasPhoto: function() {
                return (this.product.photo_path !== null);
            },

            isProductAvailable: function() {
                return (this.product.quantity > 0);
            }
        }
    }
</script>
