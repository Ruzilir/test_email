<script setup>
import ContainerWrapper from '../Components/ContainerWrapper.vue';
</script>

<template>
    <Head title="- Контакты" />

    <ContainerWrapper class="company">
        <div>
            <h2>Контакты</h2>

            <p>
                Дорогие клиенты! Мы всегда рады помочь вам! Если у вас есть вопросы, 
                предложения или вы хотите получить дополнительную информацию, не стесняйтесь 
                связаться с нами. Вот как вы можете это сделать:
            </p>

            <div class="company-info">
                <h1>Телефон:</h1>

                <p>
                    <i class="icon-tel"></i>
                    +7 (123) 456-78-90
                </p>
                
                <p>
                    <i class="icon-tel"></i>
                    +7 (987) 654-32-10
                </p>

                <h1 class="company-info">Электронная почта:</h1>

                <p>
                    <i class="icon-email"></i>
                    info@yourwebsite.com
                </p>
            </div>
        </div>

        <div>
            <h1>Часы работы: </h1>

            <p>
                <i class="icon-watch"></i>
                Пн-Пт: 09:00 - 18:00  
            </p>
            <p>
                <i class="icon-watch"></i>
                Сб-Вс: выходной  
            </p>
        </div>

        <div>
            <h1>Адрес:</h1>

            <p>
                <i class="icon-apartment"></i>
                Проспект Стачек 97 к.48 Лиговский проспект 215 Гражданский проспект, 116 к.9
            </p>
        </div>
        
        <div>
            <h1>Telegram:</h1>

            <p>
                <i class="icon-telegram2"></i>
                @example_rus
            </p>
        </div>
    </ContainerWrapper>
</template>

<style scoped lang="scss">
.icon-apartment {
    @media only screen and (max-width: 480px) {
        width: 50px;
    }
}

.company {
    display: flex;
    flex-direction: column;
    gap: 40px;

    img {
        width: 700px;
        float: right;
    }

    h2 {
        font-size: 36px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    p {
        display: flex;
        align-items: center;
        gap: 10px;

        font-size: 24px;
        font-weight: 400;
    }

    ul {
        font-size: 24px;
        font-weight: 400;

        padding-left: 40px;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    li {
        padding-top: 10px;
    }

    @media only screen and (max-width: 480px) {
        gap: 20px;

        h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            font-weight: 400;
            text-indent: 0;
        }

        ul {
            font-size: 18px;
            font-weight: 400;

            padding-left: 20px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
    }
}

.company-info {
    h1 {
        margin-top: 40px;
    }

    @media only screen and (max-width: 480px) {
        h1 {
            margin-top: 10px;
        }
    }
}
</style>