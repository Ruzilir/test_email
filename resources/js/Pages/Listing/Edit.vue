<script setup>
import ContainerWrapper from '../../Components/ContainerWrapper.vue';
import Title from '../../Components/Title.vue';
import InputField from '../../Components/InputField.vue';
import TextArea from '../../Components/TextArea.vue';
import ImageUpload from '../../Components/ImageUpload.vue';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    listing: Object,
});

const form = useForm({
    title: props.listing.title,
    desc: props.listing.desc,
    price: props.listing.price,
    email: props.listing.email,
    tel: props.listing.tel,
    image: null,
    _method: "PUT",
});
</script>

<template>
    <Head title="- Изменить Объявление" />

    <ContainerWrapper>
        <div>
            <Title>Изменить Объявление</Title>
        </div>

        <ErrorMessages :errors="form.errors" />

        <form 
            @submit.prevent="form.post(route('listing.update', listing.id))"
            class="form-new-list"
        >
            <div class="list-line">
                <InputField
                    label="Название"
                    icon="heading"
                    placeholder="Моя новая запись"
                    v-model="form.title"
                />
                
                <InputField
                    label="Цена"
                    icon="tags"
                    placeholder="Цена в руб."
                    v-model="form.price"
                />

                <TextArea
                    label="Описание"
                    icon="newspaper"
                    placeholder="Это описание моего объявления"
                    v-model="form.desc"
                />
            </div>

            <div class="list-line">
                <InputField
                    label="Ваш Email"
                    icon="email"
                    placeholder="example@mail.ru"
                    v-model="form.email"
                />

                <InputField
                    label="Телефон"
                    icon="tel"
                    placeholder="+7(999)-000-00-00"
                    v-model="form.tel"
                />

                <ImageUpload 
                    @image="(e) => (form.image = e)" 
                    :listingImage="listing.image"
                />
            </div>
            <div>
                <PrimaryBtn :disabled="form.processing">
                    Обновить
                </PrimaryBtn>
            </div>
        </form>
    </ContainerWrapper>
</template>

<style lang="scss">
.form-new-list {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-column-gap: 50px;

    margin-top: 20px;

    @media only screen and (max-width: 480px) {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
}

.list-line {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
</style>