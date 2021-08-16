<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <TheNav/>
                    </div>
                <div class="card-body">
                    <h1>Grid Data</h1>
                        <div class="row">
                            <div class="col">
                                <form>
                                    <div class="form-row">
                                        <div class="col">
                                            <DateRange :dateInfo.sync="objDate"/>
                                        </div>
                                        <div class="col">
                                            Filter by employee
                                            <select
                                                v-model="selectedEmp"
                                                name="employee"
                                                class="form-select form-select-sm mt-1 mb-2" aria-label=".form-select-sm example"
                                            >

                                            <option v-for="emp in employees" :key="emp.id" :value="emp.id">
                                                {{ emp.name }}
                                            </option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <div class="input-group input-group-sm mt-1 mb-2">
                                                Filter by customer
                                                <input class="form-control form-control-sm" type="search" v-model.lazy="search" placeholder="...">
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Product</th>
                        <th scope="col">Employee</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="sale in sales" :key="sale.id">
                        <th scope="row">{{ sale.invoiceId }}</th>
                        <td>{{ sale.product.name }}</td>
                        <td>{{ sale.employee.name }}</td>
                        <td>{{ sale.customer.full_name }}</td>
                        <td>{{ sale.date | moment}}</td>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
    import TheNav from './TheNav';
    import moment from 'moment';
    import DateRange from './DateRange.vue';

    export default {
        name: 'Grid',
        components: { TheNav, DateRange },
        data() {
            return {
                sales: [],
                employees: [],
                customers: [],
                search: null,
                selectedEmp: null,
                objDate: {},
            }
        },

        created() {
            this.getSales();
            this.getEmployees();
        },

        watch: {
            search() {
                this.getSales();
            },

            selectedEmp() {
                this.getSales();
            },

            objDate(){
                this.getSales();
            }
        },

        methods: {
            getSales() {
                axios.get('/api/sales/all', {params:{
                    search: this.search,
                    employee_id: this.selectedEmp,
                    startDate: this.objDate.startDate,
                    endDate: this.objDate.endDate,
                }}).then(
                    res => {
                        this.sales = res.data.data
                    }
                ).catch(error => {
                    console.log(error)
                })
            },

            getEmployees() {
                axios.get('/api/sales/employees').then(
                    res => {
                        this.employees = res.data
                    }
                ).catch(error => {
                    console.log(error)
                })
            },

            getCustomers() {
                axios.get('/api/sales/customers').then(
                    res => {
                        this.customers = res.data.data
                    }
                ).catch(error => {
                    console.log(error)
                })
            }
        },

        filters: {
            moment: function(value) {
                return moment(value).format('YYYY-MM-DD');
            }
        }
    }
</script>
<style></style>
