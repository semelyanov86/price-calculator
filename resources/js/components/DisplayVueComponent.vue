<template>
    <div class="card mt-2">
        <div class="card-body" v-on:click="isActive = !isActive">
            <div class="row">
                <div class="col-sm-10">
                    <h5 class="card-title">{{item.package_name}}</h5>
                </div>
                <div class="col-sm-2 text-right" style="font-size: 1em; color: Dodgerblue; cursor: pointer">
                    <i :class="getClassName"></i>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 text-center">
                <span style="font-size: 3em; color: Dodgerblue;">
                    <i class="fas fa-coins"></i>
                </span>
                    <div>
                        {{item.package_month_price}}
                    </div>
                </div>
                <div class="col-sm-3  text-center">
                <span style="font-size: 3em; color: Dodgerblue;">
                    <i class="fas fa-sms"></i>
                </span>
                    <div>
                        {{item.package_sms}}
                    </div>
                </div>
                <div class="col-sm-3  text-center">
                <span style="font-size: 3em; color: Dodgerblue;">
                    <i class="fas fa-phone"></i>
                </span>
                    <div>
                        {{item.package_minutes}}
                    </div>
                </div>
                <div class="col-sm-3  text-center">
                <span style="font-size: 3em; color: Dodgerblue;">
                    <i class="fas fa-wifi"></i>
                </span>
                    <div>
                        {{item.package_gb}}
                    </div>
                </div>
            </div>
            <div class="mt-2" v-show="isActive">
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
            </div>
        </div>
    </div>

</template>

<script>
require('../trans');
    export default {
        name: "DisplayVueComponent",
        props: {
            item: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                isActive: false
            }
        },
        computed: {
            getClassName() {
                if (this.isActive) {
                    return ['fas', 'fa-arrow-up'];
                } else {
                    return ['fas', 'fa-arrow-down'];
                }
            }
        }
    }
</script>

<style scoped>

</style>
