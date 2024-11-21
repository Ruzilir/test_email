<script setup>
import ContainerWrapper from '../../Components/ContainerWrapper.vue';
import Title from '../../Components/Title.vue';
import TextLink from '../../Components/TextLink.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="- Регистрация" />

    <ContainerWrapper>
        <div class="wrapper-width">
            <div>
                <Title>Зарегистрировать новый аккаунт</Title>
                <p class="paragraph">
                    У вас уже есть аккаунт?
                    <TextLink routeName="login" label="Вход" />
                </p>
            </div>

            <ErrorMessages :errors="form.errors" />

            <form @submit.prevent="submit">
                <div class="form-register">
                    <InputField 
                        label="Имя" 
                        icon="user" 
                        v-model="form.name" 
                    />

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
                </div>

                <p class="politic">
                    Создавая учетную запись, вы соглашаетесь с 
                    нашими Условиями обслуживания и Политикой 
                    конфиденциальности.
                </p>

                <PrimaryBtn :disabled="form.processing">
                    Регистрация
                </PrimaryBtn>
            </form>
        </div>
    </ContainerWrapper>
</template>

<style scoped lang="scss">
.paragraph {
    text-align: center;

    @media only screen and (max-width: 480px) {
        font-size: 20px;
        font-weight: 400;
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

.politic {
    font-size: 18px;
    font-weight: 500;

    margin-top: 10px;

    @media only screen and (max-width: 480px) {
        font-size: 12px;
        font-weight: 500;
    }
}

.form-register {
    display: flex;
    flex-direction: column;
    gap: 20px;

    margin-top: 20px;
}
</style>

