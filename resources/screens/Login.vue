<template>
    <main>
        <h1>i am Login</h1>
        <p>{{ newdata }}</p>
        <button @click="callApi">callApi</button>
    </main>
</template>

<script>
import { users2 } from '../actions/user';
export default {
    name: "Login",
    data() {
        return {
            newdata: '',
        }
    },
    methods: {
        async callApi() {
            let resp = await users2();
            // this.newdata = resp.data;
        }
    }
}   
</script>

<style>

</style>