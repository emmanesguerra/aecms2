<template>
    <table class="table table-striped table-bordered small">
        <thead>
            <tr>
                <th>Fieldname</th>
                <th>Old</th>
                <th>New</th>
            </tr>
        </thead>
        <tbody  v-if="isCreated">
            <tr v-for="str, key in loopdata">
                <td>{{key}}</td>
                <td>{{ displaystr(rloopdata.key) }}</td>
                <td>{{ displaystr(str) }}</td>
            </tr>   
        </tbody>
        <tbody  v-else> 
            <tr v-for="str, key in loopdata">
                <td>{{key}}</td>
                <td>{{ displaystr(str) }}</td>
                <td>{{ rloopdata(key) }}</td>
            </tr>    
        </tbody>
    </table>
</template>

<script>

    export default {
        props: ['info'],
        data () {
            return {
                data: [],
                data2: [],
            }
        },
        computed: {
            loopdata () {
                if(!_.isEmpty(this.info)) {
                    return (this.info.data.event == 'created') ? this.info.data.new: this.info.data.old;
                }
                return [];
            },
            isCreated () {
                if(!_.isEmpty(this.info)) {
                    return (this.info.data.event == 'created') ? true: false;
                }
                return false;
            }
        },
        methods: {
            displaystr(str) {
                return _.truncate(str, {
                            'length': 24,
                            'separator': /,? +/
                        });
            },
            rloopdata (index) {
                if(!_.isEmpty(this.info)) {
                    var arr = (this.info.data.event == 'created') ? this.info.data.old: this.info.data.new;
                    return _.get(arr, index);
                }
                return "";
            },
        }
        
    }
</script>s