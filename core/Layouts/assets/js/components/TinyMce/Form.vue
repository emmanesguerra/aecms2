<template>
    <div  class="form-group col-sm-12">
        <label for="html_template">{{ label }}</label>
        <Editor :name="textareaname"
            :value="value"
            :init="editorInit"
            :plugins="plugins"
            ></Editor>
    </div>
</template>

<script>
    import Editor from '@tinymce/tinymce-vue';

    export default {
        props: ['value', 'textareaname', 'label', 'height', 'toolbar', 'plugins', 'showmenu', 'styles', 'bodyclass', 'imagelists'],
        components: {
            Editor,
        },
        computed: {
            editorInit() {
                window.textarean = this.textareaname;
                return {
                    toolbar: this.toolbar,
                    height: this.height,
                    content_css: this.styles,
                    visual_table_class: 'ae-table',
                    image_advtab: true,
                    menubar: this.showmenu,
                    body_class: this.bodyclass,
                    image_list: this.imagelists,
                    relative_urls: false,
                    fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 20px 24px 26px 28px 30px 36px 48px 60px 72px",
                    init_instance_callback: function (editor) {
                        $(editor.getContainer()).find('button.tox-statusbar__wordcount').click();  // if you use jQuery
                        editor.on('change', function (e) {
                            var length = editor.contentDocument.body.innerText.length;
                            if(length > 55535) {
                                $(editor.getContainer()).find('button.tox-statusbar__wordcount').addClass('text-danger');
                            } else {
                                $(editor.getContainer()).find('button.tox-statusbar__wordcount').removeClass('text-danger');
                            }
                        });
                    }
                };
            }
        }
    }
</script>