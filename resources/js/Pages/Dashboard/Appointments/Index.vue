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
                                    <b>{{ `${arg.event.extendedProps.firstName} ${arg.event.extendedProps.lastName} - ${arg.event.extendedProps.time} ${arg.event.id}`  }}</b>
                                </template>
                             </FullCalendar>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <Modal :show="showModal">
          <CreateForm :submit="submit" :form="form" :errors=errors :changeStatusModal="changeStatusModal"/>
      </Modal>
      <Modal :show="showAppoitment">
        <ShowAppoint :appointment="appointment" :showAppoitmentModal="showAppoitmentModal" />
      </Modal>

  </AppLayout>
</template>

<script setup>
//imports
import AppLayout from "@/Layouts/AppLayout.vue";
import Modal from "@/Components/Modal.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { reactive, ref, watch } from "vue";
import ShowAppoint from './ShowAppoint.vue'
import {router, Link} from '@inertiajs/vue3'
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import CreateForm from "./forms/CreateForm.vue";
const props = defineProps({ appointments: Array, errors: Object, pacients: Array });
//refs
const showModal = ref(false)
const showCreateForm = ref(false)
const appointment = ref(null)
const showAppoitment = ref(false)
const form = reactive({
  title: '',
  start_time: '',
  description:'',
  pacient_id: "",
  date_start: null,
  price:null
})

//functions
const changeStatusModal = (type) => {
  
  if(showModal.value){
      showModal.value = false
  }else{
      return showModal.value = true
      
  }
}

const showAppoitmentModal = () => showAppoitment.value = (!showAppoitment.value ? true : false)
  


const appointments = ref(props.appointments.map(e => ({
  title: e.title,
  date: e.date_start,
  time: e.start_time,
  firstName: e.first_name,
  lastName: e.last_name,
  id: e.id
})));
const calendarOption = ref({
    plugins: [dayGridPlugin, interactionPlugin],
    initialView: 'dayGridMonth',
    events: appointments,
    locale: 'es',
    select: function(selectionInfo){
        alert('clicked on' + selectionInfo.firstName)
    },
    weekends: false,
    eventClick: (info) => {
        appointment.value = appointments.value.filter(e => e.id == info.event.id )
        showAppoitmentModal()
        console.log('hola');
    }
})




function submit(){
  console.log(props.errors);
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
    appointments.value = newAppointment.map(app => ({title: app.title, date: app.date_start,firstName: app.first_name,lastName: app.last_name,time: app.start_time,id: app.id}))
})

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
