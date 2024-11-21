<script setup>
const model = defineModel();

defineProps({
    name: String,
});
</script>

<template>
    <div class="check">
        <input
            type="checkbox"
            v-model="model"
            :id="name"
            class="checkbox"
        />
        <label
            :for="name"
            class="check-label"
        >
            <slot />
        </label>
    </div>
</template>

<style lang="scss">
.check {
    display: flex;
    align-items: center;
    gap: 15px;

    @media only screen and (max-width: 480px) {
        label {
            font-size: 20px;
            font-weight: 500;
        }
    }
}

.checkbox {
    width: 25px;
    height: 25px;
}

.check-label {
    font-size: 24px;
    font-weight: 300;
}
</style>