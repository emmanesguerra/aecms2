<template>
    <div class="card">
        <div class="card-header">Settings</div> 
        
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="col-sm-12">
                        <div  class="form-group row">
                            <h4>Website Profile</h4>
                        </div>
                        <div  v-bind:class="errors.domain_name ? 'form-row has-error' : 'form-row'">
                            <div  class="form-group  col-sm-12">
                                <label for="domain_name">Domain name *</label>
                                <input type="text" class="form-control ae-input-field" id="domain_name" v-model="info.domain_name" placeholder="ex. your.website.com">
                                <form-error v-if="errors.domain_name" :errors="errors.domain_name">
                                    {{ errors.domain_name }}
                                </form-error>
                            </div>
                        </div>
                        <div  v-bind:class="errors.website_name ? 'form-row has-error' : 'form-row'">
                            <div  class="form-group  col-sm-12">
                                <label  for="website_name">Website name *</label>
                                <input type="text" class="form-control ae-input-field" id="website_name" v-model="info.website_name" placeholder="ex. Your Website">
                                <form-error v-if="errors.website_name" :errors="errors.website_name">
                                    {{ errors.website_name }}
                                </form-error>
                            </div>
                        </div>
                        <div  v-bind:class="errors.owner ? 'form-row has-error' : 'form-row'">
                            <div  class="form-group  col-sm-12">
                                <label  for="owner">Owner</label>
                                <input type="text" class="form-control ae-input-field" id="owner" v-model="info.owner" placeholder="Owner's name">
                                <form-error v-if="errors.owner" :errors="errors.owner">
                                    {{ errors.owner }}
                                </form-error>
                            </div>
                        </div>
                        <div  class="form-group row mt-3">
                            <h4>For SEO purposes</h4>
                        </div>
                        <div  v-bind:class="errors.meta_title ? 'form-row has-error' : 'form-row'">
                            <div  class="form-group  col-sm-12">
                            <label for="meta_title">Default Page Title *</label>
                                <input type="text" class="form-control ae-input-field" id="meta_title" v-model="info.meta_title" placeholder="Default page title">
                                <form-error v-if="errors.meta_title" :errors="errors.meta_title">
                                    {{ errors.meta_title }}
                                </form-error>
                            </div>
                        </div>
                        <div  v-bind:class="errors.meta_keywords ? 'form-row has-error' : 'form-row'">
                            <div  class="form-group  col-sm-12">
                            <label for="meta_keywords">Keywords/Tags</label>
                                <input type="text" class="form-control ae-input-field" id="meta_keywords" v-model="info.meta_keywords" placeholder="Default page keywords">
                                <form-error v-if="errors.meta_keywords" :errors="errors.meta_keywords">
                                    {{ errors.meta_keywords }}
                                </form-error>
                            </div>
                        </div>
                        <div  v-bind:class="errors.meta_description ? 'form-row has-error' : 'form-row'">
                            <div  class="form-group  col-sm-12">
                                <label for="meta_description">Page Description *</label>
                                <textarea class="form-control ae-input-field" id="meta_description" v-model="info.meta_description" placeholder="Default page description" rows="5"></textarea>
                                <form-error v-if="errors.meta_description" :errors="errors.meta_description">
                                    {{ errors.meta_description }}
                                </form-error>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="col-sm-12">

                        <div  class="form-group row">
                            <h4>Email Settings</h4>
                        </div>
                        <div  v-bind:class="errors.email_recipients ? 'form-row has-error' : 'form-row'">
                            <div  class="form-group  col-sm-12">
                            <label for="email_recipients">Recipients</label>
                                <input type="text" class="form-control ae-input-field" id="email_recipients" v-model="info.email_recipients" placeholder="Recipient">
                                <form-error v-if="errors.email_recipients" :errors="errors.email_recipients">
                                    {{ errors.email_recipients }}
                                </form-error>
                            </div>
                        </div>
                        <div  v-bind:class="errors.email_cc ? 'form-row has-error' : 'form-row'">
                            <div  class="form-group  col-sm-12">
                                <label for="email_cc">CCs</label>
                                <input type="text" class="form-control ae-input-field" id="email_cc" v-model="info.email_cc" placeholder="Cc">
                                <form-error v-if="errors.email_cc" :errors="errors.email_cc">
                                    {{ errors.email_cc }}
                                </form-error> 
                            </div>
                        </div>
                        <div  v-bind:class="errors.email_bcc ? 'form-row has-error' : 'form-row'">
                            <div  class="form-group  col-sm-12">
                                <label  for="email_bcc">BCCs</label>
                                <input type="text" class="form-control ae-input-field" id="email_bcc" v-model="info.email_bcc" placeholder="Bcc">
                                <form-error v-if="errors.email_bcc" :errors="errors.email_bcc">
                                    {{ errors.email_bcc }}
                                </form-error>
                            </div>
                        </div>
                        <div  class="form-group row mt-3">
                            <h4>Server Settings</h4>
                        </div>
                        <div  v-bind:class="errors.developer ? 'form-row has-error' : 'form-row'">
                            <div  class="form-group  col-sm-12">
                                <label for="developer">Developer</label>
                                <input type="text" class="form-control ae-input-field" id="developer" v-model="info.developer" placeholder="Developer's name">
                                <form-error v-if="errors.developer" :errors="errors.developer">
                                    {{ errors.developer }}
                                </form-error>
                            </div>
                        </div>
                        <div  v-bind:class="errors.timezone ? 'form-row has-error' : 'form-row'">
                            <div  class="form-group  col-sm-12">
                                <label for="timezone">Timezone *</label>
                                <treeselect  class="ae-input-field"
                                             v-model="info.timezone"
                                             :multiple="false"
                                             :options="options"
                                             placeholder="Select a timezone" /> 
                                <form-error v-if="errors.timezone" :errors="errors.timezone">
                                    {{ errors.timezone }}
                                </form-error>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <button type="button" class="btn btn-primary">Submit</button>
                    <button @click="reset" type="button" class="btn btn-secondary">Clear</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FormError from '../FormError.vue';

    import Treeselect from '@riophae/vue-treeselect';
    import '@riophae/vue-treeselect/dist/vue-treeselect.css';
    
    export default {
        props: ['info', 'timezones', 'tags'],
        data: function () {
            return {
                errors: {},
                options: this.timezones.map(i => ({
                    id: i,
                    label: `${i}`
                  }))
            }
        },
        mounted() {
        },
        components: {
            FormError, Treeselect
        },
        methods: {
            addTag(newTag) {
                this.tags.push(newTag)
                if (this.info.meta_keywords) {
                    this.info.meta_keywords.push(newTag)
                } else {
                    this.info.meta_keywords = [];
                    this.info.meta_keywords.push(newTag);
                }
            },
            reset () {
                this.info = { };
            }
        }
    }
</script>