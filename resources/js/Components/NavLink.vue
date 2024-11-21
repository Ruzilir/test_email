<script setup>
defineProps({
    routeName: String,
    componentName: String,
})
</script>

<template>
    <Link 
        class="link-color" 
        :href="route(routeName)"
        :class="{ 'link-select' : $page.component === componentName }"
    >
        <slot />
    </Link>
</template>

<style lang="scss">
.link-color {
    color: #848484;
    padding: 5px 10px;
    margin: 5px;
    border-radius: 10px;

    &:hover {
        color: #494949;
        background-color: #e2e2e2;
    }
}

.link-select {
    color: #494949;
    background-color: #e2e2e2;
}
</style>