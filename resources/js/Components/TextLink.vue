<script setup>
defineProps({
    routeName: String,
    label: String,
})
</script>

<template>
    <Link 
        class="text-link" 
        :href="route(routeName)"
    >
        {{ label }}
    </Link>
</template>

<style lang="scss">
.text-link {
    font-weight: 700;
}
</style>