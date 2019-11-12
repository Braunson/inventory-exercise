<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="product-comment-list text-center">
                <span v-show="loading" class="spinner"></span>
                <ul>
                    <comment-view v-for="comment in comments" :comment="comment" :key="comment.id"></comment-view>
                </ul>
            </div>

            <comment-form v-on:commented="updateComment"></comment-form>
        </div>
    </div>
</template>

<script>
    import CommentView from './CommentViewComponent.vue';
    import CommentForm from './CommentFormComponent.vue';

    export default {
        props: ['product_id'],

        data () {
            return {
                comments: [],
                loading: false,
            }
        },

        components: {
            CommentView,
            CommentForm
        },

        created () {
            this.loading = true;

            // Fetch the comments 
            axios.get('/api/products/' + this.product_id + '/comments')
                .then((response) => {
                    this.comments = response.data.data;
                    this.loading = false;
                }, (response) => {
                    console.error(response);
                    this.loading = false;
                });
        },

        methods: {
            updateComment (comment) {
                this.comments.push(comment.data);
            } 
        }
    }
</script>