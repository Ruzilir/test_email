<script setup>
import ContainerWrapper from './ContainerWrapper.vue';
import Container from './Container.vue';
</script>

<template>
    <ContainerWrapper class="advertising">
        <img :src="'/storage/images/advertising/advert.png'" alt="">
    </ContainerWrapper>
</template>

<style lang="scss">
.advertising {
    padding: 0;

    overflow: hidden;

    img {
        height: 700px;
        width: 100%;

        object-fit: cover;
        object-position: center;
    }

    @media only screen and (max-width: 480px) {
        img {
            height: 250px;
        }
    }
}
</style>