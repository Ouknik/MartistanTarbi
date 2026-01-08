<template>
    <AdminLayout>

        <div class="row">
          
            <div class="col-lg-6">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between  iq-bg-warning">
                        <div class="iq-header-title">
                            <h4 class="card-title">Revenu Mensuelle / Cabinet</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <apexchart type="area" :options="barChartOptions" :series="barChartSeries"
                            style="height: 200px; width: 700px;"></apexchart>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between  iq-bg-danger">
                        <div class="iq-header-title">
                            <h4 class="card-title">Revenu Mensuelle / Bloc Operatoire</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <apexchart type="bar" :options="barChartOptionsOperation" :series="barChartSeriesOperation"
                            style="height: 200px; width: 700px;"></apexchart>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between iq-bg-primary" >
                        <div class="iq-header-title ">
                            <h4 class="card-title">Assurances</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <apexchart type="donut" :options="chartOptions" :series="chartSeries"
                            style="height: 500px; width: 700px;">
                        </apexchart>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between  iq-bg-info">
                        <div class="iq-header-title">
                            <h4 class="card-title"></h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div id="bar-chart-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import { ref } from 'vue';

const props = defineProps({
    nomAssuranceR: Array,
    countAssurance: Array,
    invoiceMonths: Array,
    invoiceAmountsPerMonth: Array,
    invoiceMonthsOperation: Array,
    invoiceAmountsPerMonthOperation: Array
});

const chartSeries = ref(props.countAssurance);

const chartOptions = ref({
    chart: {
        id: "basic-donut"
    },
    plotOptions: {
        pie: {
            customScale: 1         
        }
    },
    labels: props.nomAssuranceR,
    tooltip: {
        enabled: true,
        shared: true,
        intersect: false
    }
});


// Bar Chart Options and Series
const barChartOptions = ref({
    chart: {
        id: "invoice-bar-chart"
    },
    xaxis: {
        categories: props.invoiceMonths
    },
    tooltip: {
        enabled: true,
        shared: true,
        intersect: false
    },
    colors: ['#089bab'],
    title: {
        text: 'Revenu / Mois',
        align: 'center',
        margin: 10,
        offsetX: 0,
        offsetY: 0,
        floating: false,
        style: {
            fontSize: '16px',
            fontWeight: 'bold',
            fontFamily: undefined,
            color: '#089bab'
        },
    }
});

const barChartSeries = ref([{
    name: "Revenu",
    data: props.invoiceAmountsPerMonth
}]);



// Bar Chart Options and Series
const barChartOptionsOperation = ref({
    chart: {
        id: "invoice-bar-chart"
    },
    xaxis: {
        categories: props.invoiceMonthsOperation
    },
    tooltip: {
        enabled: true,
        shared: true,
        intersect: false
    },
    colors: ['#089bab'],
    title: {
        text: 'Revenu / Mois',
        align: 'center',
        margin: 10,
        offsetX: 0,
        offsetY: 0,
        floating: false,
        style: {
            fontSize: '16px',
            fontWeight: 'bold',
            fontFamily: undefined,
            color: '#089bab'
        },
    }
});

const barChartSeriesOperation = ref([{
    name: "Revenu",
    data: props.invoiceAmountsPerMonthOperation
}]);



</script>


