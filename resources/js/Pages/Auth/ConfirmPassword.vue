<script setup>
import ContainerWrapper from '../../Components/ContainerWrapper.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    password: "",
});

const submit = () => {
    form.post(route("password.confirm"), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head title="- Подтверждение пароля" />

    <ContainerWrapper>
        <div class="wrapper-width">
            <div>
                <p class="paragraph-conf">
                    Это безопасная область приложения. Пожалуйста, подтвердите свой
                    пароль, прежде чем продолжить.
                </p>
            </div>

            <ErrorMessages :errors="form.errors" />

            <form @submit.prevent="submit">
                <InputField 
                    label="Пароль" 
                    type="password" 
                    icon="key" 
                    v-model="form.password" 
                />

                <PrimaryBtn :disabled="form.processing">
                    Подтвердить
                </PrimaryBtn>
            </form>
        </div>
    </ContainerWrapper>
</template>

<style scoped lang="scss">
.paragraph-conf {
    text-align: justify;
    text-indent: 50px;
    margin-bottom: 50px;
}

.wrapper-width {
    width: 50%;
    margin: auto;

    padding: 20px;
    border: 2px solid #d9d9d9;
    border-radius: 10px;
}
</style>

