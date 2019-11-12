<template>
    <div class="product-comment-box" id="comment">
        <div class="loader text-center" v-show="loading">
            <span class="spinner"></span>  
        </div>

        <form method="post" @submit.prevent="submit">
            <input v-model="data.name" 
                class="input-name form-control" 
                type="text" 
                name="name" 
                placeholder="Name" 
                required>
                
            <textarea v-model="data.message" 
                class="input-message form-control"
                name="message" 
                id="message" 
                rows="3" 
                placeholder="Comment here.." 
                required></textarea>
            <input :disabled="loading" type="submit" value="Submit Comment" class="btn btn-success mb-0 btn-block">
        </form>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                loading: false,
                data: {}
            }
        },

        methods: {

            submit() {
                this.loading = true;

                // Save Comment
                axios.post('/api/products/' + this.$parent.product_id + '/comment', this.data).then((response) => {

                    // success callback
                    // fire event for comment
                    this.$emit('commented', response.data);  
                    // Clear the message
                    this.data.message = "";
                    this.loading = false;

                }, (response) => {
                    // error callback
                    this.loading = false;
                });
            }

        }
    }
</script>