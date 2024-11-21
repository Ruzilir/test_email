<script setup>

</script>

<template>
    <h1 class="title">
        <slot />
    </h1>
</template>

<style lang="scss">
.title {
    padding: 10px 0;

    font-size: 36px;
    font-weight: 700;
    text-align: center;

    @media only screen and (max-width: 480px) {
        font-size: 24px;
        font-weight: 700;
    }
}
</style>