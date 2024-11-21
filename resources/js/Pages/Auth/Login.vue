<script setup>
import ContainerWrapper from '../../Components/ContainerWrapper.vue';
import Title from '../../Components/Title.vue';
import TextLink from '../../Components/TextLink.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import SessionMessages from '../../Components/SessionMessages.vue';
import CheckBox from '../../Components/CheckBox.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    email: "",
    password: "",
    remember: null,
});

defineProps({
    status: String,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="- Вход" />

    <ContainerWrapper>
        <div class="wrapper-width">
            <div>
                <Title>Войти в свой аккаунт</Title>
                <p class="paragraph">
                    Вам нужен аккаунт?
                    <TextLink routeName="register" label="Регистрация" />
                </p>
            </div>

            <ErrorMessages :errors="form.errors" />

            <SessionMessages :status="status" />

            <form @submit.prevent="submit">
                <div class="form-login">
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
                </div>

                <div class="remember">
                    <CheckBox name="remember" v-model="form.remember" >
                        Запомнить меня
                    </CheckBox>

                    <TextLink routeName="password.request" label="Забыли пароль?" />
                </div>

                <PrimaryBtn :disabled="form.processing">
                    Вход
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

.remember {
    display: flex;
    justify-content: space-between;

    margin-top: 20px;

    @media only screen and (max-width: 480px) {
        flex-direction: column;
        gap: 10px;

        font-size: 22px;
    }
}

.form-login {
    display: flex;
    flex-direction: column;
    gap: 20px;

    margin-top: 20px;
}
</style>

