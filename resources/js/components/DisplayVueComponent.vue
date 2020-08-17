<template>
    <div class="card mt-2">
        <notifications group="dalert" />
        <loading :active.sync="isLoading"
                 :can-cancel="true"
                 :is-full-page="fullPage"></loading>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-10">
                    <h5 class="card-title">{{item.package_name}}</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2 text-center">
                    <img :src="item.logo" style="max-height: 80px;" :alt="item.provider_name">
                </div>
                <div class="col-sm-2 text-center">
                <span style="font-size: 3em; color: Dodgerblue;">
                    <i class="fas fa-coins"></i>
                </span>
                    <div>
                        {{item.package_month_price}}
                    </div>
                </div>
                <div class="col-sm-2  text-center">
                <span style="font-size: 3em; color: Dodgerblue;">
                    <i class="fas fa-sms"></i>
                </span>
                    <div>
                        {{item.package_sms}}
                    </div>
                </div>
                <div class="col-sm-2  text-center">
                <span style="font-size: 3em; color: Dodgerblue;">
                    <i class="fas fa-phone"></i>
                </span>
                    <div>
                        {{item.package_minutes}}
                    </div>
                </div>
                <div class="col-sm-2  text-center">
                <span style="font-size: 3em; color: Dodgerblue;">
                    <i class="fas fa-wifi"></i>
                </span>
                    <div>
                        {{item.package_gb}}
                    </div>
                </div>
                <div class="col-sm-2 d-flex align-items-center flex-column" v-on:click="isActive = !isActive">
                <span class="mt-auto p-2" style="font-size: 2em; color: Dodgerblue; cursor: pointer">
                    <i :class="getClassName"></i>
                </span>
                </div>
            </div>
            <div class="mt-2" v-show="isActive">
                <div class="row">
                    <div class="col-4 d-flex align-items-center">
                        <div>
                            <div class="text-center">
                            <span style="font-size: 3em; color: Dodgerblue;" class="card-img-top">
                                <i class="fas fa-shopping-cart"></i>
                            </span>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{__('site.package-interested-header')}}</h5>
                                    <p class="card-text">{{__('site.package-interested-text')}}</p>
                                    <div class="badge badge-primary text-wrap" style="width: 6rem;" v-if="item.id == choosedPackage">
                                        {{ __('site.already-ordered') }}
                                    </div>
                                    <a href="#" class="btn btn-primary" v-on:click.prevent="makeOrder" v-if="item.id != choosedPackage">{{ __('site.make-order') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <table class="table table-hover">
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
                                <td>{{item.package_minites}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __("site.package-sms") }}</th>
                                <td>{{item.package_sms}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __("site.package-gb") }}</th>
                                <td>{{item.package_gb}}</td>
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
                        <a href="#" class="text-decoration-none" v-on:click.prevent="isMore = true" v-if="!isMore">{{ __('site.show-more') }}</a>
                        <div v-if="isMore" class="container" v-html="item.other_details">
                        </div>
                        <a href="#" class="text-decoration-none" v-on:click.prevent="isMore = false" v-if="isMore">{{ __('site.hide-more') }}</a>
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
            }
        },
        created() {
            this.choosedPackage = this.ordered;
        },
    }
</script>

<style scoped>

</style>
