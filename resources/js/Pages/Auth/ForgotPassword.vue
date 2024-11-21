<script setup>
import ContainerWrapper from '../../Components/ContainerWrapper.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import SessionMessages from '../../Components/SessionMessages.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    email: "",
});

defineProps({
    status: String,
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <Head title="- Забыли пароль" />

    <ContainerWrapper>
        <div class="wrapper-width paragraph-forgot">
            <div>
                <p class="message-forgot">
                    Забыли пароль? Нет проблем. Просто сообщите нам свой адрес электронной почты, 
                    и мы вышлем вам по электронной почте ссылку для сброса пароля, которая
                    позволит вам выбрать новый.
                </p>
            </div>

            <ErrorMessages :errors="form.errors" />

            <SessionMessages :status="status" />

            <form @submit.prevent="submit">
                <InputField 
                    label="Email" 
                    icon="email" 
                    v-model="form.email" 
                />

                <PrimaryBtn :disabled="form.processing">
                    Отправить ссылку для сброса пароля
                </PrimaryBtn>
            </form>
        </div>
    </ContainerWrapper>
</template>

<style scoped lang="scss">
.paragraph-forgot {
    padding: 20px;
    margin: auto;
    border: 2px solid #d9d9d9;
    border-radius: 10px;
}

.message-forgot {
    text-align: justify;
    text-indent: 50px;
    margin-bottom: 50px;

    @media only screen and (max-width: 480px) {
        font-weight: 400;
        font-size: 20px;
        text-align: left;
        margin-bottom: 20px;
    }
}

.wrapper-width {
    width: 50%;
    margin: auto;

    @media only screen and (max-width: 480px) {
        border: 0px;
        width: 100%;
        padding: 10px;
    }
}
</style>

