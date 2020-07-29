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
                        <th scope="col">Parameter</th>
                        <th scope="col">Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">ID</th>
                        <td>{{item.id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Scan Date</th>
                        <td>{{item.date}}</td>
                    </tr>
                    <tr>
                        <th scope="row">When changed</th>
                        <td>{{item.html_changed_datetime}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Provider Name</th>
                        <td>{{item.provider_name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Package Name</th>
                        <td>{{item.package_name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Package Change Price</th>
                        <td>{{item.package_change_price}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Package Month Price</th>
                        <td>{{item.package_month_price}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Package Min Lines</th>
                        <td>{{item.package_min_lines}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Package Minutes</th>
                        <td>{{item.package_minites}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Package SMS</th>
                        <td>{{item.package_sms}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Package GB</th>
                        <td>{{item.package_gb}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Package Sim Price</th>
                        <td>{{item.package_sim_price}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Package Sim Connection Price</th>
                        <td>{{item.package_sim_connection_price}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>

<script>
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
