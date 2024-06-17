<template>
    <form
        @submit.prevent="props.submit"
        class="bg-white shadow-md rounded px-8 pt-6 pb-8"
    >
        <div class="mb-4">
            <label
                for="first_name"
                class="block text-gray-700 text-sm font-bold mb-2"
                >Título</label
            >
            <input
                type="text"
                id="title"
                v-model="props.form.title"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            />
            <p class="text-red-500" v-if="props.errors.title">
                {{ props.errors.title }}
            </p>
        </div>

        <div class="flex md:justify-evenly">
            <div class="mb-4">
                <label
                    for="date_start"
                    class="block text-gray-700 text-sm font-bold mb-2"
                    >Fecha de Inicio</label
                >
                <input
                    type="date"
                    id="date_start"
                    v-model="props.form.date_start"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />
                <p class="text-red-500" v-if="props.errors.date_start">
                    {{ props.errors.date_start }}
                </p>
            </div>
            <div class="mb-4">
                <label
                    for="start_time"
                    class="block text-gray-700 text-sm font-bold mb-2"
                    >Hora de Inicio</label
                >
                <input
                    type="time"
                    id="start_time"
                    v-model="props.form.start_time"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />
                <p class="text-red-500" v-if="props.errors.start_time">
                    {{ props.errors.start_time }}
                </p>
            </div>
        </div>
        <div class="mb-4">
            <label
                for="price"
                class="block text-gray-700 text-sm font-bold mb-2"
                >Precio</label
            >
            <input
                type="number"
                name="price"
                v-model="props.form.price"
                id="price"
                value="0"
                min="0"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            />
            <p class="text-red-500" v-if="props.errors.price">
                {{ props.errors.price }}
            </p>
        </div>
        <div class="mb-4">
            <label
                for="start_time"
                class="block text-gray-700 text-sm font-bold mb-2"
                >Descripción</label
            >
            <textarea
                v-model="form.description"
                id="description"
                rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Opcional..."
            >
            </textarea>
        </div>
        <div class="mb-4">
            <select
                id="selectElement"
                v-model="form.pacient_id"
                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
            >
                <option selected disabled value="">
                    SELECCIONA UN PACIENTE
                </option>
                <option
                    v-for="pacient in pacients"
                    :key="pacient.id"
                    :value="pacient.id"
                >
                    {{ [pacient.first_name, pacient.last_name].join(" ") }}
                </option>
            </select>
            <p class="text-red-500" v-if="props.errors.pacient_id">
                {{ props.errors.pacient_id }}
            </p>
        </div>
        <SecondaryButton type="submit" @click="props.submit">
            Crear
        </SecondaryButton>
        <button
            class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
            type="button"
            @click="changeStatusModal"
        >
            Salir
        </button>
    </form>
</template>

<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
const props = defineProps({
    submit: Function,
    form: Object,
    errors: Object,
    changeStatusModal: Function,
});
</script>

<style></style>
