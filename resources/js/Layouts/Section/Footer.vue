<script setup>
import Container from '../../Components/Container.vue';
import ContainerWrapper from '../../Components/ContainerWrapper.vue';
</script>

<template>
    <Container>
        <ContainerWrapper>
            <div class="footer-wrapper">
                <div class="footer-logo">
                    <div class="footer-big-logo">
                        <div>
                            <i class="icon-logo-big"></i>
                        </div>

                        <div>
                            CHAFFER
                        </div>
                    </div>

                    <div class="footer-icon">
                        <div>
                            <i class="icon-whatsapp"></i>
                        </div>

                        <div>
                            <i class="icon-vk"></i>
                        </div>

                        <div>
                            <i class="icon-telegram"></i>
                        </div>
                    </div>
                </div>

                <div class="footer-contact">
                    <h1>Контакты</h1>

                    <div>
                        <i class="icon-tel"></i>
                        <p>+7 (123) 456-78-90</p>
                    </div>

                    <div>
                        <i class="icon-email"></i>
                        <p>E-mail: example@gmail.com</p>
                    </div>
                    
                    <div>
                        <i class="icon-telegram2"></i>
                        <p>Telegram: @example_rus</p>
                    </div>
                    
                    <div>
                        <i class="icon-apartment"></i>
                        <p>
                            Проспект Стачек 97 к.48
                            Лиговский проспект 215
                            Гражданский проспект, 116 к.9
                        </p>
                    </div>
                </div>

                <div class="footer-news">
                    <h1>Для клиента</h1>
                    <p>Как купить</p>
                    <p>Доставка и оплата</p>
                    <p>Кредит</p>
                    <p>Политика конфиденциальности</p>
                    <p>Вопросы и ответы (F.A.Q.)</p>
                    <p>Сервис и гарантия</p>
                </div>
                
                <div class="footer-company">
                    <h1>О компании</h1>
                    <p>Отзывы</p>
                    <p>Наши преимущества</p>
                    <p>История компании</p>
                    <p>Сотрудничество</p>
                    <p>Партнёрская программа</p>
                    <p>Вакансии</p>
                </div>
            </div>

            <div class="footer-copyright">
                CHAFFER &copy; 2024 Все права защищены
            </div>
        </ContainerWrapper>
    </Container>
</template>

<style lang="scss">
.footer-wrapper {
    display: flex;
    justify-content: space-around;
    gap: 20px;

    padding: 50px 0;
    border-bottom: 2px solid #d9d9d9;

    @media only screen and (max-width: 480px) {
        display: flex;
        flex-direction: column;
    }
}

.footer-big-logo {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;

    font-size: 36px;
    font-weight: 700;
}

.footer-icon {
    display: flex;
    gap: 20px;

    margin-top: 20px;
}

.footer-copyright {
    margin-top: 20px;
    text-align: center;

    font-size: 20px;
    font-weight: 300;
}

.footer-contact {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;

    div {
        display: flex;
        align-items: start;
        gap: 10px;
    }

    h1 {
        font-size: 24px;
        font-weight: 700;
    }

    p {
        font-size: 18px;
        font-weight: 300;
        width: 300px;
    }
}

.footer-logo {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
}

.footer-company {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;

    h1 {
        font-size: 24px;
        font-weight: 700;
    }

    p {
        font-size: 18px;
        font-weight: 300;
        width: 300px;
    }
}

.footer-news {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;

    h1 {
        font-size: 24px;
        font-weight: 700;
    }

    p {
        font-size: 18px;
        font-weight: 300;
        width: 300px;
    }
}
</style>