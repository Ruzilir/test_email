<script setup>
import ContainerWrapper from '../../../Components/ContainerWrapper.vue';
import Title from '../../../Components/Title.vue';
import InputField from '../../../Components/InputField.vue';
import PrimaryBtn from '../../../Components/PrimaryBtn.vue';
import ErrorMessages from '../../../Components/ErrorMessages.vue';
import SessionMessages from '../../../Components/SessionMessages.vue';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
    status: String,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
});

const resendEmail = (e) => {
    router.post(
        route("verification.send"),
        {},
        {
            onStart: () => (e.target.disabled = true),
            onFinish: () => (e.target.disabled = false),
        }
    );
};
</script>

<template>
    <ContainerWrapper>
        <div class="form-account">
            <div>
                <Title>Обновите информацию</Title>
                <p>
                    Обновите информацию о профиле вашей учетной 
                    записи и адрес электронной почты.
                </p>
            </div>

            <ErrorMessages :errors="form.errors" />

            <form @submit.prevent="form.patch(route('profile.info'))" class="form-update-info">
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

                <div v-if="user.email_verified_at === null" class="email-conf">
                    <SessionMessages class="session-email" :status="status" />

                    <p>Ваш адрес электронной почты не подтвержден.</p>

                    <button
                        @click="resendEmail"
                        class="button-email"
                    >
                        Нажмите здесь, чтобы повторно отправить письмо с подтверждением.
                    </button>
                </div>

                <PrimaryBtn :disabled="form.processing">
                    Сохранить
                </PrimaryBtn>
            </form>
        </div>
    </ContainerWrapper>
</template>

<style scoped lang="scss">
.email-conf {
    margin-top: 20px;
}

.form-account {
    width: 50%;
    margin: auto;

    @media only screen and (max-width: 480px) {
        width: 100%;
    }
}

.button-email {
    text-align: start;
    color: #4336ff;
    font-weight: 500;
    text-decoration: underline;

    &:disabled {
        cursor: wait;
        color: #878787;
    }
}

.session-email {
    margin-bottom: 20px;
}

.form-update-info {
    display: flex;
    flex-direction: column;
    gap: 20px;

    margin-top: 20px;
}
</style>