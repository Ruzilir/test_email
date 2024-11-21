<script setup>
import ContainerWrapper from '../../../Components/ContainerWrapper.vue';
import Title from '../../../Components/Title.vue';
import InputField from '../../../Components/InputField.vue';
import PrimaryBtn from '../../../Components/PrimaryBtn.vue';
import ErrorMessages from '../../../Components/ErrorMessages.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const showConfirmPassword = ref(false);

const form = useForm({
    password: "",
});

const submit = () => {
    form.delete(route("profile.destroy"), {
        onFinish: () => form.reset(),
        preserveScroll: true,
    });
};
</script>

<template>
    <ContainerWrapper>
        <div class="form-account">
            <div>
                <Title>Удалить учетную запись</Title>
                <p>
                    Как только ваш аккаунт будет удален, все его данные и ресурсы будут
                    безвозвратно удалены. Это действие нельзя отменить.
                </p>
            </div>

            <ErrorMessages :errors="form.errors" />

            <div v-if="showConfirmPassword">
                <form @submit.prevent="submit">
                    <InputField
                        label="Подтвердите пароль"
                        icon="key"
                        type="password"
                        v-model="form.password"
                    />

                    <PrimaryBtn class="mob-enter" :disabled="form.processing">
                        Подтвердить
                    </PrimaryBtn>

                    <button 
                        class="button-cancel"
                        @click="showConfirmPassword = false"
                    >
                        Отмена
                    </button>
                </form>
            </div>

            <button 
                v-if="!showConfirmPassword"
                @click="showConfirmPassword = true"
                class="button-warning"
            >
                <i class="icon-warning"></i>
                Удалить аккаунт
            </button>
        </div>
    </ContainerWrapper>
</template>

<style lang="scss">
.form-account {
    width: 50%;
    margin: auto;

    p {
        margin-bottom: 20px;
    }

    @media only screen and (max-width: 480px) {
        width: 100%;
    }
}

.button-warning {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;

    margin-top: 20px;
    padding: 15px;
    border-radius: 15px;
    background-color: rgb(203, 50, 50);
    
    color: #000;
    font-weight: 600;
}

.button-cancel {
    color: #9146f3;
    font-weight: 600;
    text-decoration: underline;
    margin-left: 40px;
}

.mob-enter {
    @media only screen and (max-width: 480px) {
        font-size: 20px;
        font-weight: 600;
    }
}
</style>