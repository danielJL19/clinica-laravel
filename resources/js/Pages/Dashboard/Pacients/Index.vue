<template>
    <AppLayout title="Pacientes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pacientes
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
                                <div class="overflow-hidden">
                                    <table
                                        class="min-w-full text-left text-sm font-light text-surface dark:text-white"
                                    >
                                        <thead
                                            class="border-b border-neutral-200 font-medium dark:border-white/10"
                                        >
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    #
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Nombre Completo
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Edad
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Telefono
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                class="border-b border-neutral-200 dark:border-white/10"
                                                v-for="pacient in pacients"
                                                :key="pacient.id"
                                            >
                                                <td
                                                    class="whitespace-nowrap px-6 py-4 font-medium"
                                                >
                                                    {{ pacient.id }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{ pacient.first_name }} {{ pacient.last_name }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{ pacient.age }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{pacient.phone}}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    <button 
                                                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2"
                                                        @click="deletePacient(pacient.id)"
                                                        >
                                                        Eliminar
                                                    </button>
                                                    <Link
                                                        v-bind:href="`/pacients/${pacient.id}/edit`"
                                                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                                                    >
                                                        Editar Paciente
                                                    </Link>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
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
                    >Nombre</label>
                    <input 
                        type="text" 
                        id="first_name" 
                        v-model="form.first_name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Carlos"
                    >
                    <p class="text-red-500" v-if="errors.first_name">{{errors.first_name}}</p>
                </div>
                <div class="mb-4">
                    <label 
                        for="last_name"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >Apellido</label>
                    <input 
                        type="text" 
                        id="last_name" 
                        v-model="form.last_name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Jiménez"
                        
                    >
                    <p class="text-red-500" v-if="errors.last_name">{{errors.last_name}}</p>
                </div>
                <div class="mb-4">
                    <label 
                        for="age"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >Edad</label>
                    <input 
                        type="number" 
                        id="age" 
                        v-model="form.age"
                        placeholder="28"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                    <p class="text-red-500" v-if="errors.age">{{errors.age}}</p>
                </div>
                <div class="mb-4">
                    <label 
                        for="phone"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >Teléfono</label>
                    <input 
                        type="text" 
                        id="phone" 
                        v-model="form.phone"
                        placeholder="(56)99443467"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                    <p class="text-red-500" v-if="errors.phone">{{errors.phone}}</p>
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
import { reactive, ref } from "vue";
import {router, Link} from '@inertiajs/vue3'
defineProps({ pacients: Array, errors: Object });
const showModal = ref(false)
const changeStatusModal = () => {
    if(showModal.value){
        return showModal.value = false
    }else{
        return showModal.value = true
    }

}


const form = reactive({
    first_name: 'holdsadas',
    last_name: null,
    age: null,
    phone: null,
})

function submit(){
    router.post('/pacients',form, {
        onSuccess: res => {
            showModal.value = false
            swal("Good job!", "You clicked the button!", "success");
            console.log(form.value.first_name);
            form.first_name = ''
            form.last_name = ''
            form.age = ''
            form.phone = ''
        }
    })
}

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

<style></style>
