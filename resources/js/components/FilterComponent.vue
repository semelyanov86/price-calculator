<template>
    <div class="card-body">
        <notifications group="alert" />
        <loading :active.sync="isLoading"
                 :can-cancel="true"
                 :is-full-page="fullPage"></loading>
        <button type="button" class="btn btn-primary btn-lg btn-block" v-show="shouldCollapse" v-on:click="collapsable = false">{{ __('site.search-again') }}</button>
        <form @submit.prevent="submit_form" v-if="!shouldCollapse">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="company_id">{{ __("site.choose-company") }}</label>
                    <select class="form-control" id="company_id" v-model="choosedCompany">
                        <option :value="company.provider_name" v-for="company in companies" :key="company.id">{{company.provider_name}}</option>
                    </select>
                    <div class="alert alert-danger" v-if="errors && errors.provider_name">
                        {{ errors.provider_name[0] }}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="lines">{{ __("site.no-of-lines") }}</label>
                    <select class="form-control" id="lines" :value="lines" v-on:change="changeLines($event)">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <div class="alert alert-danger" v-if="errors && errors.lines">
                        {{ errors.lines[0] }}
                    </div>
                </div>
            </div>
            <div class="form-row" v-for="cur in lines">
                <div class="form-group col-md-2">
                    <label :for="'phone' + cur">{{ __("site.phone-number") }}</label>
                    <input :id="'phone' + cur" type="tel" class="form-control" name="phone[]" v-model="phone[cur]">
                    <div class="alert alert-danger" v-if="errors && errors.phone">
                        {{ errors.phone[0] }}
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label :for="'minutes' + cur">{{ __("site.number-of-minutes") }}</label>
                    <input :id="'minutes' + cur" type="number" class="form-control" name="minutes[]" v-model="minutes[cur]">
                    <div class="alert alert-danger" v-if="errors && errors.minutes">
                        {{ errors.minutes[0] }}
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label :for="'sms' + cur">{{ __("site.sms") }}</label>
                    <input :id="'sms' + cur" type="number" class="form-control" name="sms[]" v-model="sms[cur]">
                    <div class="alert alert-danger" v-if="errors && errors.sms">
                        {{ errors.sms[0] }}
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label :for="'gb' + cur">{{ __("site.gb") }}</label>
                    <input :id="'gb' + cur" type="number" class="form-control" name="gb[]" v-model="gb[cur]">
                    <div class="alert alert-danger" v-if="errors && errors.gb">
                        {{ errors.gb[0] }}
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label :for="'roaming' + cur">{{ __('site.calls-to-countries') }}</label>
                    <input :id="'roaming' + cur" type="number" class="form-control" name="roaming[]" v-model="roaming[cur]">
                    <div class="alert alert-danger" v-if="errors && errors.roaming">
                        {{ errors.roaming[0] }}
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label :for="'price' + cur">{{ __('site.your-current-price') }}</label>
                    <input :id="'price' + cur" type="number" class="form-control" name="price[]" v-model="price[cur]">
                    <div class="alert alert-danger" v-if="errors && errors.price">
                        {{ errors.price[0] }}
                    </div>
                </div>
            </div>
            <button class="btn btn-primary sm-block" type="submit">{{ __('site.Search') }}</button>
        </form>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';
    export default {
        name: "FilterComponent",
        components: {
            Loading
        },
        data() {
            return {
                choosedCompany: null,
                lines: 1,
                phone: [null, null],
                minutes: [null, null],
                sms: [null, null],
                gb: [null, null],
                roaming: [null, null],
                price: [null, null],
                isLoading: false,
                record: null,
                fullPage: true,
                errors: {},
                collapsable: true
            }
        },
        props: {
            companies: {
                type: Object,
                required: true
            },
            type: {
                type: String,
                required: true
            },
            id: {
                type: [String, Boolean],
                required: false,
                default: false
            },
            filter: {
                type: String,
                required: true
            }
        },
        created() {
            this.choosedCompany = this.companies[0].provider_name;
        },
        mounted() {
            const prefill = JSON.parse(this.filter);
            this.parsePrefill(prefill);
        },
        computed: {
            getPayload() {
                return {
                    'choosedCompany' : this.choosedCompany,
                    'type' : this.type,
                    'lines' : this.lines,
                    'phone' : this.phone,
                    'minutes' : this.minutes,
                    'sms' : this.sms,
                    'gb' : this.gb,
                    'roaming' : this.roaming,
                    'price' : this.price
                }
            },
            getUrl() {
                const id = parseInt(this.id)
                if (id && id > 0) {
                    return '/api/data/' + id;
                } else {
                    return '/api/data';
                }
            },
            shouldCollapse() {
                return this.collapsable && this.id != '';
            }
        },
        methods: {
            changeLines(e) {
                const value = parseInt(e.target.value);
                this.lines = value;
                for (let i = 0; i <= value; i++) {
                    if (!this.phone[i]) {
                        this.phone[i] = null
                    }
                    if (!this.minutes[i]) {
                        this.minutes[i] = null
                    }
                    if (!this.sms[i]) {
                        this.sms[i] = null
                    }
                    if (!this.gb[i]) {
                        this.gb[i] = null
                    }
                    if (!this.roaming[i]) {
                        this.roaming[i] = null
                    }
                    if (!this.price[i]) {
                        this.price[i] = null
                    }
                }
            },
            submit_form() {
                const self = this;
                this.isLoading = true;
                axios.post(this.getUrl, this.getPayload).then(response => {
                    self.record = response.data.id;
                    self.isLoading = false;
                    self.errors = {};
                    window.location.href = '/phone/' + self.record;
                }).catch(error => {
                    self.$notify({
                        group: 'alert',
                        title: 'Error during searching data',
                        text: error.message
                    });
                    if (error.response.status === 422) {
                        self.errors = error.response.data.errors;
                    }
                    self.isLoading = false;
                })
            },
            parsePrefill(prefill) {
                for (const field in prefill) {
                    this[field] = prefill[field];
                }
            }
        }
    }
</script>

<style scoped>
@media all and (max-width:480px) {
    .sm-block { width: 100%; display:block; }
}
</style>
