<template>
    <div class="form-row">
        <div  class="form-group col-sm-12">
            <label for="name">Panel name for {!! {{ model.panel }} !!}</label>
            <input minlength="4" maxlength="50" v-if="selected == 'NEW'" type="text" class="form-control ae-input-field" id="name" v-bind:name="inputname" placeholder="Panel name" required/>
            <select v-model='selected' class="form-control ae-input-field"  v-else  v-bind:name="selectname" required>
                <option v-for='selections in contents' :value='selections.id'>{{ selections.name }}</option>
            </select>
        </div> 
        <tinymce-form  v-if="selected == 'NEW'"
                       :value="model.html_template"
                       :textareaname="textname"
                       :label="editorlabel"
                       :height="editorheight"
                       :toolbar="editortoolbar"
                       :plugins="editorplugins"
                       :showmenu="editordisplaymenu">
        </tinymce-form>
    </div>
</template>

<script>

    export default {
        props: ['model', 'contents'],
        data () {
            return {
                selected: this.model.selected,
                editorlabel: "Content",
                editorheight: 400,
                editortoolbar: 'undo redo | styleselect |  fontsizeselect forecolor bold italic underline | link unlink | alignleft aligncenter alignright | bullist numlist | image ',
                editorplugins: 'code print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount imagetools textpattern help',
                editordisplaymenu: true
            }
        },
        computed: {
            classObject () {
                if(this.selected == 'NEW') {
                    return 'show';
                } else {
                    return 'hide';
                }
            },
            inputname () {
                return 'contents[' + this.model.panel + '][name]';
            },
            textname () {
                return 'contents[' + this.model.panel + '][html_template]';
            },
            selectname () {
                return 'contents[' + this.model.panel + '][selected_panel]';
            }
        },
        components: {
            onSelect(data) {
                this.selected = data.id;
            } 
        }
    }
</script>