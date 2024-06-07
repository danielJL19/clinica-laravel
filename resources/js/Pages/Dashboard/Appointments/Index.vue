<template>
  <AppLayout title="Citas">
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Citas
          </h2>
      </template>

      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-5 py-3">
                  <PrimaryButton type="button" @click="changeStatusModal">Crear</PrimaryButton>
                  <div class="flex flex-col">
                      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div
                              class="inline-block min-w-full py-2 sm:px-6 lg:px-8"
                          >
                             <FullCalendar :options="calendarOption">
                                <template v-slot:eventContent='arg'>
                                    <b>{{ `${arg.event.extendedProps.firstName} ${arg.event.extendedProps.lastName} - ${arg.event.extendedProps.time}` }}</b>
                                    
                                </template>
                             </FullCalendar>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <Modal :show="showModal">
          <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            
              <div class="mb-4">
                  <label 
                      for="first_name"
                      class="block text-gray-700 text-sm font-bold mb-2"
                  >Título</label>
                  <input 
                      type="text" 
                      id="title" 
                      v-model="form.title"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      
                  >
                  <p class="text-red-500" v-if="errors.title">{{errors.title}}</p>
              </div>


              <div class="flex md:justify-evenly">
                <div class="mb-4">
                    <label 
                        for="date_start"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >Fecha de Inicio</label>
                    <input 
                        type="date"
                        id="date_start" 
                        v-model="form.date_start"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"   
                    >
                    <p class="text-red-500" v-if="errors.date_start">{{errors.date_start}}</p>
                </div>
                <div class="mb-4">
                    <label 
                        for="start_time"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >Hora de Inicio</label>
                    <input 
                        type="time"
                        id="start_time" 
                        v-model="form.start_time"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"   
                    >
                    <p class="text-red-500" v-if="errors.start_time">{{errors.start_time}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label 
                    for="price"
                    class="block text-gray-700 text-sm font-bold mb-2"
                >Precio</label>
                <input 
                    type="number" 
                    name="price" 
                    v-model="form.price"
                    id="price"
                    value="0"
                    min="0"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                >
                <p class="text-red-500" v-if="errors.price">{{errors.price}}</p>

              </div>
              <div class="mb-4">
                <label 
                    for="start_time"
                    class="block text-gray-700 text-sm font-bold mb-2"
                >Descripción</label>
                <textarea 
                    v-model="form.description"
                    id="description" 
                    rows="4" 
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    placeholder="Opcional...">
                </textarea>
              </div>
              <div class="mb-4">
                <select 
                    id="selectElement"
                    v-model="form.pacient_id"
                    class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                >     
                    <option selected disabled value="">--SELECCIONA UN PACIENTE--</option>
                    <option v-for="pacient in pacients" :key="pacient.id" :value="pacient.id">{{ [pacient.first_name, pacient.last_name].join(' ') }}</option>

                </select>
                <p class="text-red-500" v-if="errors.pacient_id">{{errors.pacient_id}}</p>
              </div>
              <SecondaryButton type="submit">
                  Crear Paciente
              </SecondaryButton>
              <button 
                  class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                  type="button"
                  @click="changeStatusModal"
              >
                  Salir
              </button>
          </form>

      </Modal>

  </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Modal from "@/Components/Modal.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { reactive, ref, watch } from "vue";

import {router, Link} from '@inertiajs/vue3'
const props = defineProps({ appointments: Array, errors: Object, pacients: Array });
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import Login from "@/Pages/Auth/Login.vue";
import Tooltip from "tooltip.js";


const showModal = ref(false)
const changeStatusModal = () => {
  if(showModal.value){
      return showModal.value = false
  }else{
      return showModal.value = true
  }

}

const appointments = ref(props.appointments.map(e => ({
  title: e.title,
  date: e.date_start,
  time: e.start_time,
  firstName: e.first_name,
  lastName: e.last_name
})));

const calendarOption = ref({
    plugins: [dayGridPlugin, interactionPlugin],
    initialView: 'dayGridMonth',
    eventDidMount: function(info){
        var tooltip = new Tooltip(info.el, {
            title:'<div style="background-color:blue;padding: 1rem .5rem;border-radius:5px;"> <span style="color:white;">'+ info.event.title+'</span></div>',
            placement: 'top',
            trigger: 'hover',
            container:'body',
            html: true
        })
    },
    events: appointments,
    locale: 'es',
    select: function(selectionInfo){
        alert('clicked on' + selectionInfo)
    },
    weekends: false,
    eventClick: (info) => {
        console.log(info.event);
    }
})


const form = reactive({
  title: null,
  start_time: null,
  description:null,
  pacient_id: "",
  date_start: null,
  price:null
})

function submit(){
  router.post('/appointments',form, {
      onSuccess: res => {
          showModal.value = false
          swal("Good job!", "You clicked the button!", "success");
          form.first_name = ''
          form.last_name = ''
          form.age = ''
          form.phone = ''
      }
  })
}

watch(() => props.appointments, async (newAppointment, oldAppointment) => {
    console.log('new: ', newAppointment);
    appointments.value = newAppointment.map(app => ({title: app.title, date: app.date_start,firstName: app.first_name,lastName: app.last_name,time: app.start_time}))
}, {deep: true})

const deletePacient = (id) => {
  swal({
title: "Estás Seguro?",
text: "Al eliminarlo, ya no podras recuperar este registro",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
  router.delete(`/pacients/${id}`)
  swal("Poof! Tu registro ha sido salvado", {
    icon: "success",
  });
} else {
  swal("Tu registro se ha eliminado con éxito");
}
});
  
}
</script>

<style scoped>
.custom-tooltip {
    background-color: #333;
    color: #fff;
    font-size: 14px;
    padding: 10px;
    border-radius: 5px;
}
</style>
