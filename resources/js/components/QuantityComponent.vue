<template>
    <div class="quantity-toggle">
        <button @click="decrement($event)">&mdash;</button>
        <input type="text" :value="quantity" readonly>
        <button @click="increment($event)">&#xff0b;</button>
    </div>
</template>

<script>
    export default {
        props: {
            maxQuantity: {
                default: 1,
                type: Number|String
            }
        },
        data() {
            return {
                quantity: 1
            };
        },
        methods: {
            increment(event) {
                event.preventDefault();

                if (this.maxQuantity == this.quantity) {
                    alert('Max quantity reached');
                } else {
                    this.quantity++;
                }
            },
            decrement(event) {
                event.preventDefault();

                if (this.quantity === 1) {
                    alert('Negative quantity not allowed');
                } else {
                    this.quantity--;
                }
            }
        }
    }
</script>
