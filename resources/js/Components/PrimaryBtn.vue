<script setup>

</script>

<template>
    <button class="btn">
        <slot />
    </button>
</template>

<style lang="scss">
.btn {
    padding: 15px;
    margin-top: 30px;
    border-radius: 10px;

    background-color: rgb(0, 0, 0);
    color: #ffffff;

    &:disabled {
        cursor: wait;
        background-color: rgb(86, 86, 86);
    }

    &:hover {
        background-color: rgb(86, 86, 86);
    }
}
</style>