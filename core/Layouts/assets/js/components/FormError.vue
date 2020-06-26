<template>
    <span class="help-block">
        <span v-for="error in errors">
            <span v-if="isString(error)">
                {{ error }}
            </span>
            <span v-else  v-for="err in error">
                {{ err }} <br />
            </span>
        </span>    
    </span>
</template>

<script>
    export default {
        props: ['errors'],
        methods: {
            isString (error) {
                return _.isString(error);
            }
        }
    }
</script>