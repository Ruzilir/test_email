<script setup>
import ContainerWrapper from '../../Components/ContainerWrapper.vue';
import Title from '../../Components/Title.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    token: String,
    email: String,
})

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("password.update"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="- Сбросить пароль" />

    <ContainerWrapper>
        <div class="wrapper-width">
            <div>
                <Title>Введите новый пароль</Title>
            </div>

            <ErrorMessages :errors="form.errors" />

            <form @submit.prevent="submit">
                <InputField 
                    label="Email" 
                    icon="email" 
                    v-model="form.email" 
                />

                <InputField 
                    label="Пароль" 
                    type="password" 
                    icon="key" 
                    v-model="form.password" 
                />

                <InputField 
                    label="Подтверждение пароля" 
                    type="password" 
                    icon="key" 
                    v-model="form.password_confirmation" 
                />

                <PrimaryBtn :disabled="form.processing">
                    Сбросить пароль
                </PrimaryBtn>
            </form>
        </div>
    </ContainerWrapper>
</template>

<style lang="scss">
.wrapper-width {
    width: 50%;
    margin: auto;
}
</style>

