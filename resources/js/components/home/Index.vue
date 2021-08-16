<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header"><TheNav/></div>
          <div class="card-body">

            <h1>Dashboard</h1>
            <!-- Date range -->
            <DateRange :dateInfo.sync="objDate"/>
            <!-- End -->
            <div class="row mt-5" v-if="sales.length > 0">
                <div class="col">
                    <h2>Day Sales</h2>
                    <line-chart :chartdata="sales" :options="chartoptions" label="2020" :chartcolors="daysalescol"></line-chart>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
    import TheNav from './TheNav';
    import DateRange from './DateRange.vue';
    import LineChart from './LineChart.vue';
    import moment from 'moment';

    export default {
        components: {
            TheNav,
            LineChart,
            DateRange
        },
        data() {

            return {

                sales: [],
                chartoptions: {
                    responsive: true,
                    maintainAspectRatio: false
                },
                daysalescol: {
                    borderColor: "#784F41",
                    pointBorderColor: "#784F41",
                    pointBackgroundColor: "#88E5ED",
                    backgroundColor:"#88E5ED",
                },
                objDate: {},
                startFormatDate:'',
                endFormatDate: '',

            }
        },

        beforeCreate() {
            localStorage.clear()
        },

        created(){
            this.getSales();
        },

        watch: {
            objDate(){
                this.startFormatDate = moment(this.objDate.startDate).format('YYYY-MM-DD');
                this.endFormatDate = moment(this.objDate.endDate).format('YYYY-MM-DD');
                this.getSales();
                localStorage.setItem('objDate', JSON.stringify(this.objDate))
            }
        },

        mounted() {
            if (localStorage.getItem("objDate")){
                this.objDate = JSON.parse(localStorage.getItem("objDate"))
                }
            },

        methods: {
            getSales() {
                axios.get('/api/sales', {
                    params:{
                        startDate: this.startFormatDate,
                        endDate: this.endFormatDate,
                    }
                }).then(
                    res => {
                        this.sales = res.data
                    }).catch(error => {
                        console.log(error)
                    })
            }
        }

        // async created(){

        //     const { data } = await axios.get('/api/sales');

        //     data.forEach( d => {
        //         const date = moment(d.date,'YYYY-MM-DD').format('MM/DD');
        //         const total = d.total;

        //         this.sales.push({date, total});

        //     })

        // },
    }
</script>

<style scoped>
.slot {
  background-color: #aaa;
  padding: 0.5rem;
  color: white;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.text-black {
  color: #000;
}
</style>
