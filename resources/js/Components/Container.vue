<script setup>

</script>

<template>
    <div class="container">
        <slot />
    </div>
</template>

<style lang="scss">
.container {
    max-width: 1400px;
    margin: 0 auto;

    @media only screen and (max-width: 480px) {
        padding: 0 5px;
    }
}
</style>