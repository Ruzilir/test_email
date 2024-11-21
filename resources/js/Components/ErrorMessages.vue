<script setup>
defineProps({
    errors: Object,
});
</script>

<template>
    <div class="error" v-if="Object.keys(errors).length">
        <p>Что-то пошло не так!</p>

        <ul>
            <li v-for="(error, i) in errors" :key="i">
                {{ error }}
            </li>
        </ul>
    </div>
</template>

<style lang="scss">
.error {
    color: rgb(186, 0, 0);
    font-size: 20px;
    font-weight: 600;
    margin-top: 20px;

    ul {
        list-style-position: inside;
        padding-left: 20px;
        font-weight: 500;
    }
}
</style>