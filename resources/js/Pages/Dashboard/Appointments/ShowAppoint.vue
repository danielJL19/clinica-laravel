<template>
<h2 class="text-6xl text-gray-900 dark:text-white text-center my-3">{{ `${capitalize(props.appointment[0].firstName)} ${capitalize(props.appointment[0].lastName) }` || 'NO EXISTE' }}</h2>

<div class="flex justify-center">
  <div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

              <tr>
                  <td class="bg-gray-50 px-2">
                    Fecha Inicio
                  </td>
                  <td scope="col" class="px-6 py-3">
                      {{props.appointment[0].date }}
                  </td>

              </tr>
              <tr>
                  <td class="bg-gray-50 px-2">
                    Hora Inicio
                  </td>
                  <td scope="col" class="px-6 py-3">
                      {{props.appointment[0].time}}
                  </td>

              </tr>
    
      </table>
  </div>
  <div>
    <p>{{ props.appointment[0].title }}</p>
  </div>
</div>

<div class="flex justify-center my-3">
  <SecondaryButton @click="showAppoitmentModal">
    Salir
  </SecondaryButton>
</div>
</template>

<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import {capitalize} from '@/Services/decorate' 
const props = defineProps({
  appointment: Object,
  showAppoitmentModal: Function
})
</script>

<style>

</style>