<template>
    <date-range-picker v-model="dateRange" showDropdowns auto-apply :ranges='false'>

    <!--    input slot (new slot syntax)-->
    <template #input="picker" style="min-width: 350px;">
        {{ picker.startDate | date }} - {{ picker.endDate | date }}
    </template>
    <!--    date slot-->
    <template #date="data">
        <span class="small">{{ data.date | dateCell }}</span>
    </template>
    <!--    ranges (new slot syntax) -->
    <template #ranges="ranges">
        <div class="ranges">
            <ul>
                <li v-for="(range, name) in ranges.ranges" :key="name" @click="ranges.clickRange(range)">
                    <b>{{ name }}</b> <small class="text-muted">{{ range[0].toDateString() }} - {{ range[1].toDateString() }}</small>
                </li>
            </ul>
        </div>
    </template>
    </date-range-picker>
</template>

<script>
    import DateRangePicker from 'vue2-daterange-picker';
    import 'vue2-daterange-picker/dist/vue2-daterange-picker.css';

    export default {
        name: 'DateRange',
        components: {
            DateRangePicker,
        },

        data(){

            return {
                dateRange: JSON.parse(localStorage.getItem("objDate")) ? JSON.parse(localStorage.getItem("objDate")) : {}
            }

        },

        props: {
            dateInfo: {
                type: Object,
                default: null
            }
        },
        watch: {
            dateRange() {
                this.toParent()
            }
        },
        methods: {
            toParent(){
                //console.log(this.dateRange);
                this.$emit('update:dateInfo', this.dateRange)
            }
        },

        filters: {
            dateCell (value) {
            let dt = new Date(value)
            return dt.getDate()
            },

            date (val) {

            return val ?  val.toLocaleDateString("en-US", { day: 'numeric' })+ "-"
                + val.toLocaleDateString("en-US", { month: 'short' })
                + "-" + val.toLocaleDateString("en-US", { year: 'numeric' })  : ''

            },
        }
    }
</script>

<style>

</style>
