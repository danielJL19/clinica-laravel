<template>
  <AppLayout title="Editar Paciente">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Paciente
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
                <button 
                    type="submit"
                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                >
                    Editar Paciente
                </button>
                <Link 
                    class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                    
                    href="/pacients"
                >
                    Salir
                </Link>
            </form>
                </div>
            </div>
        </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, Link } from '@inertiajs/vue3'
import { reactive } from 'vue'
const props = defineProps({pacient: Object, errors: Object})

const form = useForm({
  first_name: props.pacient.first_name,
  last_name: props.pacient.last_name,
  age: props.pacient.age,
  phone: props.pacient.phone
})

const submit = () => {
  form.put(`/pacients/${props.pacient.id}`,{
    onSuccess: next=> console.log('Se ha creado ocn éxito')
  })
}
</script>

<style>

</style>