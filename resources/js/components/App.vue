<template>
    <div>
        <h4 class="text-center">Hello World!</h4>
        <h5>Hello</h5>
        <p>Count is {{ count }}</p>
        <button @click="count--">-</button>
            {{ count }}
        <button @click="count++">+</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            count: 0
        }
    }
}
</script>

<style>

</style>