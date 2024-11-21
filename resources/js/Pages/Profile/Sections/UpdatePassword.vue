<script setup>
import ContainerWrapper from '../../../Components/ContainerWrapper.vue';
import Title from '../../../Components/Title.vue';
import InputField from '../../../Components/InputField.vue';
import PrimaryBtn from '../../../Components/PrimaryBtn.vue';
import ErrorMessages from '../../../Components/ErrorMessages.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.put(route("profile.password"), {
        onSuccess: () => form.reset(),
        onError: () => form.reset(),
        preserveScroll: true,
    });
};
</script>

<template>
    <ContainerWrapper>
        <div class="form-account">
            <div>
                <Title>Обновить пароль</Title>
                <p>
                    Убедитесь, что вы используете длинный случайный 
                    пароль для обеспечения безопасности.
                </p>
            </div>

            <ErrorMessages :errors="form.errors" />

            <form @submit.prevent="submit" class="form-update-password">
                <InputField 
                    label="Текущий Пароль"
                    icon="key"
                    type="password"
                    v-model="form.current_password"
                />

                <InputField
                    label="Новый пароль"
                    icon="key"
                    type="password"
                    v-model="form.password"
                />

                <InputField
                    label="Подтверждение нового пароля"
                    icon="key"
                    type="password"
                    v-model="form.password_confirmation"
                />

                <p 
                    v-if="form.recentlySuccessful" 
                    class="saved-password"
                >
                    Сохранено!
                </p>

                <PrimaryBtn :disabled="form.processing">
                    Сохранить
                </PrimaryBtn>
            </form>
        </div>
    </ContainerWrapper>
</template>

<style scoped lang="scss">
.form-account {
    width: 50%;
    margin: auto;

    @media only screen and (max-width: 480px) {
        width: 100%;
    }
}

.saved-password {
    color: #0cf600;
    margin-top: 20px;
}

.form-update-password {
    display: flex;
    flex-direction: column;
    gap: 20px;

    margin-top: 20px;
}
</style>