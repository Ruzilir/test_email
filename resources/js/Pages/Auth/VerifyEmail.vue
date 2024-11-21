<script setup>
import { useForm } from '@inertiajs/vue3';
import ContainerWrapper from '../../Components/ContainerWrapper.vue';
import SessionMessages from '../../Components/SessionMessages.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';

const form = useForm({});

defineProps({
    status: String,
});

const submit = () => {
    form.post(route('verification.send'));
}

</script>

<template>
    <Head title="- Подтверждение почты" />

    <ContainerWrapper>
        <div class="email-confirmation">
            <div class="email-text">
                <p>
                    Спасибо за регистрацию! Прежде чем начать, не могли бы вы проверить
                    свой адрес электронной почты, нажав на ссылку, на которую мы только 
                    что отправили электронное письмо? Если вы не получили письмо, мы 
                    с радостью отправим вам другое.
                </p>
            </div>

            <SessionMessages :status="status" />

            <form @submit.prevent="submit">
                <PrimaryBtn :disabled="form.processing">
                    Повторно отправить письмо с подтверждением
                </PrimaryBtn>
            </form>  
        </div>
    </ContainerWrapper>
</template>

<style lang="scss">
.email-confirmation {
    width: 50%;
    padding: 20px;
    margin: auto;
    border: 2px solid #d9d9d9;
    border-radius: 10px;
}

.email-text {
    text-align: justify;
    text-indent: 50px;
}
</style>