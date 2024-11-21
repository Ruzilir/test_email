<script setup>
const model = defineModel();
defineProps({
    label: String,
    icon: String,
    placeholder: {
        type: String,
        default: "",
    },
});
</script>

<template>
    <div class="input-field">
        <label
            :for="label"
        >
            {{ label }}
        </label>

        <div class="textarea-icon">
            <div>
                <i :class="`icon-${icon}`"></i>
            </div>
            <textarea
                rows="6"
                :name="label"
                :placeholder="placeholder"
                v-model="model"
            ></textarea>
        </div>
    </div>
</template>

<style lang="scss">
.input-field {

    label {
        font-weight: 700;
    }
}

.textarea-icon {
    display: flex;
    align-items: start;

    border: 2px solid #d9d9d9;
    border-radius: 5px;

    padding: 10px;

    &:hover {
        border: 2px solid #000000;
    }

    div {
        display: flex;
        align-items: center; 

        margin-right: 10px;
    }

    textarea {
        width: 100%;
        padding: 10px;
    }
}
</style>