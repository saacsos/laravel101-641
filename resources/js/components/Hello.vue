<template>
    <div>
        <h1>{{ message }}</h1>
        <button @click="up()">{{ counter }}</button>
    </div>
</template>

<script>

export default {
    data() {
        return {
            message: 'Hello Vue',
            counter: 0
        }
    },
    methods: {
        up() {
            this.counter++;
        }
    }
}
</script>
