<template>
    <div>
        <form @submit.prevent="registro" class="max-w-sm mx-auto">
            <div class="mb-5">
                <label
                    for="name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Nombre</label
                >
                <input
                    name="name"
                    v-model="form.name"
                    type="text"
                    id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="name@flowbite.com"
                    required
                />
            </div>
            <div class="mb-5">
                <label
                    for="email"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Email</label
                >
                <input
                    name="email"
                    v-model="form.email"
                    type="email"
                    id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="name@flowbite.com"
                    required
                />
            </div>

            <div class="mb-5">
                <label
                    for="telefono"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Telefono</label
                >
                <input
                    name="telefono"
                    v-model="form.telefono"
                    type="text"
                    id="telefono"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="name@flowbite.com"
                    required
                />
            </div>

            <div class="mb-5">
                <label
                    for="imagen_perfil"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Imagen de perfil</label
                >
                <input
                    name="imagen_perfil"
                    type="file"
                    id="imagen_perfil"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    @change="handleFileChange"
                    accept="image/*"
                    required
                />
            </div>

            <div class="mb-5">
                <label
                    for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Contraseña</label
                >
                <input
                    name="password"
                    v-model="form.password"
                    type="password"
                    id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required
                />
            </div>

            <div class="mb-5">
                <label
                    for="password2"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Confirmar Contraseña</label
                >
                <input
                    name="password2"
                    v-model="form.password2"
                    type="password"
                    id="password2"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required
                />
                <p v-if="isMatch.passwordMatch" class="text-red-500 text-sm mt-1">
                    Las contraseñas no coinciden.
                </p>
                <p class="text-red-500 text-sm mt-1" v-for="(error, k) in errors" :key="k">
                    {{ error }}
                </p>

            </div>
            <button
                type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Registrarme
            </button>

            <Link
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-5"
                            href="/login"
                            >Iniciar Sesion</Link
                        >
              
        </form>
    </div>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            form: {
                name: "",
                telefono: "",
                imagen_perfil: null, 
                email: "",
                password: "",
                password2: "", // Campo para confirmar contraseña
            },
            isMatch: {
                passwordMatch: false,
                 // Estado del error de contraseña
            },
            errors: []
        };
    },
    methods: {
        handleFileChange(event) {

            this.errors = [];

            const file = event.target.files[0];
            if (file) {
                this.form.imagen_perfil = file; // Asignar el archivo al objeto `form`
            }
        },
        registro() {
            // Validar contraseñas
            if (this.form.password !== this.form.password2) {
                this.isMatch.passwordMatch = true;
                return;
            } else {
                this.isMatch.passwordMatch = false;
            }

            const formData = new FormData();
            formData.append("name", this.form.name);
            formData.append("telefono", this.form.telefono);
            formData.append("imagen_perfil", this.form.imagen_perfil);
            formData.append("email", this.form.email);
            formData.append("password", this.form.password);

            axios
                .post("/registro", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    this.$inertia.visit('/login');
                })
                .catch((error) => {
                    if(error.response && error.response.status){
                        const status = error.response.status

                        if (status == 422){
                            const errors = error.response.data.errors;
                            this.errors = Object.values(errors).flat();
                        } else{

                            this.errors = ['Error en el sevidor:' + status]

                        } 
                        }else{
                            this.errors = ['Error inesperado']

                    }
                });
        },
    },
};
</script>
