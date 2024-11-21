<script setup>
defineProps({
    status: String,
});
</script>

<template>
    <div v-if="status" class="status">
        {{ status }}
    </div>
</template>

<style lang="scss">
.status {
    color: #00e02d;
    font-size: 20px;
    font-weight: 500;
    padding-top: 20px;
}
</style>