<template>
    <div class="form-row">
        <div  class="form-group col-sm-12">
            <label for="name">Panel name</label>
            <input type="text" class="form-control ae-input-field" id="name" placeholder="Panel name" />
        </div> 
        <div  class="form-group col-sm-12">
            <label for="html_template">Brief Description</label>
            <Editor :init="{
                        toolbar: 'undo redo | styleselect |  fontsizeselect forecolor bold italic underline | link unlink | alignleft aligncenter alignright | bullist numlist | image ',
                        height: 400, 
                        importcss_append: true, 
                        forced_root_block: '',
                        content_css:['../css/templates/bootstrap.min.css', 
                                     '../css/templates/common.css'],
                        visual_table_class:'ae-table'
                    }"
                    plugins='code print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help'
                    ></Editor>
        </div>
    </div>
</template>

<script>

    import Editor from '@tinymce/tinymce-vue'

    export default {
        props: ['model'],
        components: {
            Editor,
        }
    }
</script>