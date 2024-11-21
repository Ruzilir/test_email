<script setup>

</script>

<template>
    <div class="container-wrapper">
        <slot />
    </div>
</template>

<style lang="scss">
.container-wrapper {
    border-radius: 10px;
    border: 2px solid #d9d9d9;
    margin-top: 30px;
    padding: 20px 30px;

    box-shadow: 5px 10px 15px 0 #c9c9c9;

    @media only screen and (max-width: 480px) {
        margin-top: 20px;
        padding: 10px;
    }
}
</style>