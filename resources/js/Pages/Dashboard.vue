<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import {Bar} from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import { ref } from 'vue';
ChartJS.register(Title,Tooltip,Legend,BarElement,CategoryScale,LinearScale)
const chartData = ref({
    labels: ['January','February','March'],
    datasets: [{data: [40,20,12]}]
})
const chartOptions = ref({
    Responsive: true
})
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Bar
    id="my-chart-id"
    :options="chartOptions"
    :data="chartData"
  />

                </div>
            </div>
        </div>
    </AppLayout>
</template>
