<template>
    <div class="login-container">
        <form @submit.prevent="enviarFormulario" class="max-w-sm mx-auto">
            <div class="mb-5">
                <label
                    for="email"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Email</label
                >
                <input
                    type="email"
                    id="email"
                    v-model="form.email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="name@flowbite.com"
                    required
                />
            </div>
            <div class="mb-5">
                <label
                    for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Password</label
                >
                <input
                    type="password"
                    id="password"
                    v-model="form.password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required
                />
            </div>
            <div class="flex items-start mb-5">
                <p class="text-red-500 text-sm mt-1" v-for="(error, k) in errors" :key="k">
                    {{ error }}
                </p>
            </div>
           

            <button
                type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Iniciar Sesion
            </button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            form: {
                email: "",
                password: "",
            },
            errors: []
        };
   
    },
    methods: {
        enviarFormulario() {
            this.errors = [];

            axios.post("login", {
                    email: this.form.email, 
                    password: this.form.password, 
                    
                })
                .then((res) => {
                    console.log('aqui');
                    this.$inertia.visit('/inicio');
                })
                .catch((error) => {
                    if(error.response && error.response.status){
                        const status = error.response.status

                        if (status == 422){
                            const errors = error.response.data.errors;
                            this.errors = Object.values(errors).flat();
                        }else if(status == 401){
                            this.errors = ['Credenciales incorrectas']
                        } else{

                            this.errors = ['Error en el sevidor:' + status]

                        } 
                        }else{
                            this.errors = ['Error inesperado']

                    }
                });
    },
}
};
</script>
