<script setup>
import Container from '../Components/Container.vue';
import Header from './Section/Header.vue';
import Footer from './Section/Footer.vue';
</script>

<template>
    <Header />

    <main>
        <Container>
            <slot />
        </Container>
    </main>

    <Footer />
</template>

<style lang="scss">

</style>