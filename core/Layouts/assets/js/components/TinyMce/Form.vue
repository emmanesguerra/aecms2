<template>
    <div  class="form-group col-sm-12">
        <label for="html_template">Brief Description</label>
        <Editor :name="textareaname"
                :model="model.html_template"
                :init="{
                    toolbar: 'undo redo | styleselect |  fontsizeselect forecolor bold italic underline | link unlink | alignleft aligncenter alignright | bullist numlist | image ',
                    height: 400, 
                    content_css:['../css/templates/bootstrap.min.css', 
                                 '../css/templates/common.css'],
                    visual_table_class:'ae-table',
                    image_advtab: true
                }"
                plugins='code print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help'
                ></Editor>
    </div>
</template>

<script>

    import Editor from '@tinymce/tinymce-vue'

    export default {
        props: ['model', 'textareaname'],
        components: {
            Editor,
        }
    }
</script>