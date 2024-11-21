<script setup>
import { ref } from 'vue';

const emit = defineEmits(['image']);

const props = defineProps({
    listingImage: String,
});

const currentImage = props.listingImage
    ? `/storage/${props.listingImage}`
    : null;

const preview = ref(currentImage);
const oversizedImage = ref(false);
const showRevertBtn = ref(false);

const imageSelected = (e) => {
    preview.value = URL.createObjectURL(e.target.files[0]);
    oversizedImage.value = e.target.files[0].size > 3145728;
    showRevertBtn.value = true;
    emit('image', e.target.files[0]);
};

const revertImageChange = () => {
    showRevertBtn.value = false;
    preview.value = currentImage;
    oversizedImage.value = false;
    emit("image", null);
};
</script>

<template>
    <div>
        <span 
            class="span-image"
            :class="{'span-image-red' : oversizedImage}"
        >
            {{
                oversizedImage
                    ? "Размер выбранного изображения превышает 3 МБ."
                    : "Изображение (Максимальный размер 3 МБ.)"
            }}
        </span>

        <label 
            class="label-image" 
            :class="{'label-image-red' : oversizedImage}"
            for="image" 
        >
            <img
                :src="preview ?? '/storage/images/listing/default.jpeg'"
                class="image-new-list"
                alt=""
            />

            <button
                class="btn-refresh"
                v-if="showRevertBtn"
                @click.prevent="revertImageChange"
                type="button"
            >
                <i class="icon-refresh"></i>
            </button>
        </label>
        
        <input 
            @input="imageSelected"
            type="file" 
            name="image" id="image"
            hidden
        >
    </div>
</template>

<style lang="scss">
.span-image {
    display: block;
    font-size: 18px;

    margin-bottom: 7px;
}

.span-image-red {
    color: #ff0000;
}

.label-image {
    display: block;
    position: relative;
    
    overflow: hidden;
    cursor: pointer;
    height: 225px;

    border-radius: 5px;
    border: 2px solid #d9d9d9;

    background-color: rgb(98, 98, 98);

    &:hover {
        border-color: #000000;
    }
}

.label-image-red {
    border-color: #ff0000;
}

.image-new-list {
    width: 100%;
    height: 100%;

    object-fit: cover;
    object-position: center;
}

.btn-refresh {
    position: absolute;
    top: 20px;
    right: 20px;

    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;

    background-color: #ffffff;
    width: 40px;
    height: 40px;
}
</style>