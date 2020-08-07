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
                       :textareaname="textname">
        </tinymce-form>
    </div>
</template>

<script>

    export default {
        props: ['model', 'contents'],
        data () {
            return {
                selected: this.model.selected
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