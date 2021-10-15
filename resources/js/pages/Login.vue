<template>
    <div>
        <input v-model="email" type="text">
        <input v-model="password" type="text">
        <button @click="login">Login</button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Login",
    data() {
        return {
            email: "",
            password: ""
        }
    },
    methods: {
        login() {
            axios.post('/login', {
                email: this.email,
                password: this.password,
            }).then(response => {
                window.location.reload();
            })
        },
    },
    mounted() {
    }
}
</script>

<style scoped>

</style>
