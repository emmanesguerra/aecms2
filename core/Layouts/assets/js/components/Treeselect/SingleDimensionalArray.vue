<template>
    <treeselect v-if="forpagetemplate"  v-bind:class="haserror ? 'ae-input-field is-invalid' : 'ae-input-field'" 
                 v-model="modelvalue"
                 :name="fieldname"
                 :multiple="false"
                 :options="options" 
                 @select="getTemplateUnescapedVariables"/> 
    <treeselect v-else  v-bind:class="haserror ? 'ae-input-field is-invalid' : 'ae-input-field'" 
                 v-model="modelvalue"
                 :name="fieldname"
                 :multiple="false"
                 :options="options" />
</template>

<script>
    import Treeselect from '@riophae/vue-treeselect';
    import '@riophae/vue-treeselect/dist/vue-treeselect.css';

    export default {
        props: ['value', 'selectoptions', 'haserror', 'fieldname', 'forpagetemplate', 'forpagetemplateurl'],
        data: function () {
            return {
                modelvalue: this.value,
                options: this.selectoptions.map(i => ({
                        id: i,
                        label: `${i}`
                    }))
            }
        },
        mounted() {
        },
        components: {
            Treeselect
        },
        methods: {
            getTemplateUnescapedVariables (node) {
                axios.get(this.forpagetemplateurl, {params:{template: node.label}})
                .then(function(response) {
                    window.app.panels = response.data.data;
                });
            }
        }
    }
</script>