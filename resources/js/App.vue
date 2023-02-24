<template>
    <div class="container mx-auto">
        <div
            class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left"
        >
            <p class="text-slate-600">
                Crear dos BBDD ejecutar migraciones y crear dos post que
                identifiquen cada BBDD
            </p>
            <h1 class="text-lg">BBDD actual {{ current_bd }}</h1>
        </div>
        <div class="mt-2">
            <button
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150' mr-2"
                @click="config(bd_master)"
            >
                1. Configura BD Master
            </button>
            <button
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'"
                @click="config(bd_dynamic)"
            >
                2. Configura BD Dinámica
            </button>
        </div>
        <div class="mt-2">
            <button
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'"
                @click="post"
            >
                A. Post
            </button>
        </div>
        <div class="mt-2">
            <button
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'"
                @click="binding"
            >
                B. Post via model Binding + middelware
            </button>
        </div>
        <div class="mt-2">
            <button
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'"
                @click="override"
            >
                C. Post via model Binding + Extend DynamicModel
            </button>
        </div>
        <div class="mt-2">
            <span class="text-xl text-blue-600" v-if="titulo != null">
                El post es: {{ titulo }}
            </span>
            - {{ origen }}
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            bd_master: "laravel",
            bd_dynamic: "laravel2",
            current_bd: "no config",
            titulo: null,
            origen: null,
        };
    },

    mounted() {},
    methods: {
        config(bd) {
            axios.get(`/config/${bd}`).then((res) => {
                this.titulo = null;
                this.current_bd = res.data;
            });
        },
        post() {
            axios
                .get(`/post`)
                .then((res) => {
                    this.titulo = res.data;
                    this.origen = "A: Directo middleware";
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {});
        },
        binding() {
            axios
                .get(`/post/1`)
                .then((res) => {
                    this.titulo = res.data;

                    this.origen =
                        "B: Model binding - FALLA cuando seleccionamos BD dinámica!!";
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {});
        },
        override() {
            axios
                .get(`/postb/1`)
                .then((res) => {
                    this.titulo = res.data;
                    this.origen = "C: Extendiendo DynamicModel - ok!";
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {});
        },
    },
};
</script>
