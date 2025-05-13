<template>
    <ApexChart
    type="pie"
    height="350"
    :options="chartOptions"
    :series="series"
    />
</template>

<script setup>
import { ref, onMounted } from 'vue'
import ApexChart from 'vue3-apexcharts'
import axios from 'axios'

const series = ref([])
const chartOptions = ref({
    labels: ['Peserta Daftar Ulang', 'Peserta Tidak Lanjut / Lulus'],
    colors: ['#008FFB', '#FF4560'],
    legend: {
        position: 'top'
    },
    tooltip: {
        y: {
            formatter: val => `${val} peserta`
        }
    },
    responsive: [
    {
        breakpoint: 480,
        options: {
            chart: {
                width: 300
            },
            legend: {
                position: 'bottom'
            }
        }
    }
    ]
})

onMounted(async () => {
    const { data } = await axios.get('tahsin-chart-data-2')

    series.value = data.values
    chartOptions.value.labels = data.labels
})
</script>
