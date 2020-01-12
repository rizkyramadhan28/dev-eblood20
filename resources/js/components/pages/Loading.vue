<template>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Loading</div>

            <div class="card-body" id="loading">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>

                <p>Loading ...</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    computed: {}
};
</script>

<style scoped>
#loading {
    text-align: center;
}
</style>
