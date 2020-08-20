<template>
    <div class="card mt-2">
        <notifications group="dalert" />
        <loading :active.sync="isLoading"
                 :can-cancel="true"
                 :is-full-page="fullPage"></loading>
        <div class="card-body">
            <div class="row" style="cursor: pointer" v-on:click="isActive = !isActive">
                <div class="col-sm-10">
                    <h5 class="card-title">{{item.package_name}}</h5>
                </div>
            </div>

            <div class="row" style="cursor: pointer" v-on:click="isActive = !isActive">
                <div :class="getArrowAlignOpposite">
                    <img :src="item.logo" style="max-height: 80px;" :alt="item.provider_name">
                </div>
                <div class="col-sm-2 text-center">
                <span class="superIcon">
                    <i class="fas fa-coins"></i>
                </span>
                    <div>
                        {{item.package_month_price}} {{__('site.money-sign')}}
                    </div>
                </div>
                <div class="col-sm-2  text-center">
                <span class="superIcon">
                    <i class="fas fa-sms"></i>
                </span>
                    <div>
                        {{getNumDisplayValue(item.package_sms)}} {{__('site.sms')}}
                    </div>
                </div>
                <div class="col-sm-2  text-center">
                <span class="superIcon">
                    <i class="fas fa-phone"></i>
                </span>
                    <div>
                        {{getNumDisplayValue(item.package_minutes)}} {{__('site.minutes')}}
                    </div>
                </div>
                <div class="col-sm-2  text-center">
                <span class="superIcon">
                    <i class="fas fa-wifi"></i>
                </span>
                    <div>
                        {{getNumDisplayValue(item.package_gb)}} {{__('site.gb')}}
                    </div>
                </div>
                <div :class="getArrowAlign">
                <span class="mt-auto p-2 superIcon" style="cursor: pointer">
                    <i :class="getClassName"></i>
                </span>
                </div>
            </div>
            <div class="mt-2" v-show="isActive">
                <div class="row">
                    <div class="col-4 align-items-center mt-3">
                        <div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{__('site.package-interested-header')}}</h5>
                                    <p class="card-text">{{__('site.package-interested-text')}}</p>
                                    <div class="badge badge-primary text-wrap" style="width: 6rem;" v-if="item.id == choosedPackage">
                                        {{ __('site.already-ordered') }}
                                    </div>
                                    <a href="#" class="btn btn-primary mt-3" v-on:click.prevent="makeOrder" v-if="item.id != choosedPackage">{{ __('site.make-order') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="container detailsContainer" v-html="item.other_details">
                        </div>
                        <a href="#" class="text-decoration-none mr-2" v-on:click.prevent="isMore = true" v-if="!isMore">{{ __('site.show-more') }}</a>
                        <table class="table table-hover" v-if="isMore">
                            <thead>
                            <tr>
                                <th scope="col">{{ __("site.parameter") }}</th>
                                <th scope="col">{{ __("site.value") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">{{ __("site.package-change-price") }}</th>
                                <td>{{item.package_change_price}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __("site.package-month-price") }}</th>
                                <td>{{item.package_month_price}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __("site.package-min-lines") }}</th>
                                <td>{{item.package_min_lines}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __("site.package-minutes") }}</th>
                                <td>{{getNumDisplayValue(item.package_minites)}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __("site.package-sms") }}</th>
                                <td>{{getNumDisplayValue(item.package_sms)}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __("site.package-gb") }}</th>
                                <td>{{getNumDisplayValue(item.package_gb)}} {{__('site.gb')}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __("site.package-sim-price") }}</th>
                                <td>{{item.package_sim_price}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __("site.package-sim-connection-price") }}</th>
                                <td>{{item.package_sim_connection_price}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __("site.minutes-to-other-countries") }}</th>
                                <td>{{item.minutes_to_other_countries}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="#" class="text-decoration-none mr-2" v-on:click.prevent="isMore = false" v-if="isMore">{{ __('site.hide-more') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
require('../trans');
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
    export default {
        name: "DisplayVueComponent",
        components: {
            Loading
        },
        props: {
            item: {
                type: Object,
                required: true
            },
            id: {
                type: String,
                required: true
            },
            ordered: {
                type: String,
                required: false,
            }
        },
        data() {
            return {
                isActive: false,
                isMore: false,
                isLoading: false,
                fullPage: true,
                order: null,
                choosedPackage: null
            }
        },
        computed: {
            getClassName() {
                if (this.isActive) {
                    return ['fas', 'fa-arrow-up'];
                } else {
                    return ['fas', 'fa-arrow-down'];
                }
            },
            getUrl() {
                const id = parseInt(this.id);
                return '/api/user-data/order/' + id;
            },
            getPayload() {
                return {
                    'scan' : this.item.id,
                }
            },
            getArrowAlign() {
                if (window._locale == 'he') {
                    return ['col-sm-2', 'text-left'];
                } else {
                    return ['col-sm-2', 'text-right'];
                }
            },
            getArrowAlignOpposite() {
                if (window._locale == 'he') {
                    return ['col-sm-2', 'text-right'];
                } else {
                    return ['col-sm-2', 'text-left'];
                }
            },
        },
        methods: {
            makeOrder() {
                const self = this;
                this.isLoading = true;
                axios.post(this.getUrl, this.getPayload).then(response => {
                    self.choosedPackage = response.data.scan;
                    self.isLoading = false;
                    self.$notify({
                        group: 'dalert',
                        title: 'Data ordered',
                        text: "You successfully ordered package"
                    });
                }).catch(error => {
                    self.$notify({
                        group: 'dalert',
                        title: 'Error during order package',
                        text: error.message
                    });
                    self.isLoading = false;
                })
            },
            getNumDisplayValue(val) {
                if (val == 100000) {
                    return this.__('site.unlimit');
                } else {
                    return val;
                }
            }
        },
        created() {
            this.choosedPackage = this.ordered;
        },
    }
</script>

<style scoped>
.card-title {
    margin-bottom: 1.5rem;
}
.superIcon {
    font-size: 2em;
    color: Dodgerblue;
}
</style>
