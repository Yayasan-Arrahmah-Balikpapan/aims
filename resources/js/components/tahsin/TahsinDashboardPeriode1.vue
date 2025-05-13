<!-- <template>
<div v-if="chartData">
<Line :data="chartData" :options="chartOptions" />
</div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { Line } from 'vue-chartjs'
import {
Chart as ChartJS,
Title,
Tooltip,
Legend,
LineElement,
PointElement,
CategoryScale,
LinearScale,
Filler
} from 'chart.js'
import ChartDataLabels from 'chartjs-plugin-datalabels'

ChartJS.register(
Title,
Tooltip,
Legend,
LineElement,
PointElement,
CategoryScale,
LinearScale,
Filler,
ChartDataLabels
)

const chartData = ref(null)

const chartOptions = {
responsive: true,
plugins: {
legend: {
position: 'top',
},
title: {
display: true,
text: 'Statistik Peserta per Angkatan',
},
tooltip: {
callbacks: {
label: (context) => {
const label = context.dataset.label || ''
const value = context.parsed.y
return `${label}: ${value}`
}
}
},
datalabels: {
color: '#000',
anchor: 'end',
align: 'top',
font: {
weight: 'bold',
size: 10
},
formatter: (value) => value > 0 ? value : ''
}
},
scales: {
y: {
beginAtZero: true,
max: 2000,
ticks: {
stepSize: 500
}
}
}
}

onMounted(async () => {
const response = await axios.get('chart-data')
chartData.value = {
labels: response.data.labels,
datasets: response.data.datasets
}
})
</script> -->


<template>
    <ApexCharts
    type="line"
    height="450"
    :options="chartOptions"
    :series="series"
    />
</template>

<script setup>
import ApexCharts from 'vue3-apexcharts'
import { ref, onMounted } from 'vue'
import axios from 'axios'

const series = ref([])
const chartOptions = ref({
    chart: {
        type: 'line',
        zoom: {
            enabled: true
        },
        toolbar: {
            tools: {
                download: true,
                zoom: true,
                pan: true,
                reset: true
            }
        }
    },
    stroke: {
        width: [5, 3, 3, 2, 2, 2, 5],
        dashArray: [0, 9, 9, 0, 0, 0, 0],
        curve: 'smooth'
    },
    fill: {
        type: ['solid', 'solid', 'solid', 'solid', 'solid', 'solid', 'solid'],
        opacity: [0.6, 0.6, 0.6, 1, 1, 1, 0.6]
    },
    markers: {
        size: 5
    },
    dataLabels: {
        enabled: true,
        formatter: function (val) {
            return val === 0 ? '' : val
        }
    },
    tooltip: {
        shared: true,
        intersect: false,
        y: {
            formatter: val => val
        }
    },
    xaxis: {
        categories: [] // diisi dari API
    },
    legend: {
        position: 'top',
        horizontalAlign: 'center'
    },
    colors: ['#00E396', '#FEB019', '#008FFB', '#0000FF', '#FF4560', '#FF0000', '#775DD0']
})

onMounted(async () => {
    const { data } = await axios.get('tahsin-chart-data-1') // sesuaikan dengan route Laravel kamu

    chartOptions.value.xaxis.categories = data.labels
    series.value = data.datasets.map(dataset => ({
        name: dataset.label,
        data: dataset.data
    }))
})
</script>

