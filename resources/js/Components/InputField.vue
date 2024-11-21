<script setup>
const model = defineModel();
defineProps({
    label: String,
    icon: String,
    placeholder: {
        type: String,
        default: "",
    },
    type: {
        type: String,
        default: "text",
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

        <div class="input-icon">
            <div>
                <i :class="`icon-${icon}`"></i>
            </div>
            <input
                :type="type"
                :name="label"
                :placeholder="placeholder"
                v-model="model"
            />
        </div>
    </div>
</template>

<style lang="scss">
.input-field {

    label {
        font-weight: 700;
    }

    @media only screen and (max-width: 480px) {
        font-weight: 400;
        font-size: 20px;
    }
}

.input-icon {
    display: flex;
    align-items: center;

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

    input {
        flex-grow: 1;
        cursor: pointer;

        @media only screen and (max-width: 480px) {
            width: 245px;
        }
    }
}
</style>