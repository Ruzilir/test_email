<script setup>
import { ref } from 'vue';
import ContainerWrapper from '../../Components/ContainerWrapper.vue';
import { router } from '@inertiajs/vue3';

const show = ref(false);

const props = defineProps({
    listing: Object,
    user: Object,
    canModify: Boolean,
});

const deleteListing = () => {
    if (confirm("Вы уверены, что хотите удалить запись?")) {
        router.delete(route("listing.destroy", props.listing.id));
    }
};

const toggleApprove = () => {
    let msg = props.listing.approved
        ? "Отклонить это объявление?"
        : "Одобрить это объявление?";

    if (confirm(msg)) {
        router.put(route("admin.approve", props.listing.id));
    }
};
</script>

<template>
    <div v-show="show" @click="show = false" class="showImg"></div>


    <Head title="- Детали объявления" />

    <div
        v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'"
        class="show-listing-approved"
    >
        <p>
            Этот объявление {{ listing.approved ? "Одобрено" : "Отклонено" }}.
        </p>
        <button @click.prevent="toggleApprove">
            {{ listing.approved ? 'Отклонить' : 'Одобрить' }}
        </button>
    </div>

    <ContainerWrapper class="container-show-listing">
        <button @click="show = !show" class="show-listing">
            <img
                :src="
                    listing.image
                        ? `/storage/${listing.image}`
                        : '/storage/images/listing/default.jpeg'
                "
                class="show-listing-image"
                alt=""
            />
            
            <img
                :src="
                    listing.image
                        ? `/storage/${listing.image}`
                        : '/storage/images/listing/default.jpeg'
                "
                class="img-big"
                v-show="show"
                alt=""
            />
        </button>

        <div class="show-listing-description">
            <div>
                <div class="show-listing-title">
                    <p>
                        Детали объявления
                    </p>

                    <div v-if="canModify" class="show-edit-delete">
                        <Link 
                            :href="route('listing.edit', listing.id)"
                            class="show-edit-link"
                        >
                            Изменить
                        </Link>

                        <button
                            @click="deleteListing"
                            class="show-delete-btn"
                            type="button"
                        >
                            Удалить
                        </button>
                    </div>
                </div>

                <h3 class="listing-title-text">{{ listing.title }}</h3>

                <p class="listing-title-desc">{{ listing.desc }}</p>
            </div>

            <div class="listing-contact">
                <p class="listing-contact-p">Контактная информация</p>

                <div v-if="listing.email" class="listing-contact-info">
                    <i class="icon-email-big"></i>
                    <p>Email:</p>
                    <a :href="`mailto:${listing.email}`" class="">
                        {{ listing.email }}
                    </a>
                </div>
                
                <div v-if="listing.tel" class="listing-contact-info">
                    <i class="icon-tel"></i>
                    <p>Телефон:</p>

                    <p>
                        {{ listing.tel }}
                    </p>
                </div>
                
                <div class="listing-contact-info">
                    <i class="icon-user"></i>
                    <p>Пользователь:</p>
                    <Link :href="route('home', { user_id: user.id })">
                        {{ user.name }}
                    </Link>
                </div>
            </div>
        </div>
    </ContainerWrapper>
</template>

<style lang="scss">
.container-show-listing {
    display: flex;
    gap: 40px;

    @media only screen and (max-width: 480px) {
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
}

.showImg {
    position: fixed;
    background: #0000008d;
    inset: 0px;
    z-index: 10;
}

.img-big {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 10;

    height: 90vh;

    @media only screen and (max-width: 480px) {
        height: 50vh;
    }
}

.show-listing {
    width: 25%;
    height: 400px;
    overflow: hidden;

    border-radius: 10px;
    border: 2px solid #d9d9d9;

    @media only screen and (max-width: 480px) {
        width: 100%;
    }
}

.show-listing-image {
    width: 100%;
    height: 100%;

    object-fit: cover;
    object-position: center;
}

.show-listing-description {
    width: 100%;
    padding: 10px;
    

    border-radius: 10px;
    border: 2px solid #d9d9d9;
}

.show-listing-title {
    display: flex;
    align-items: center;
    justify-content: space-between;

    border-bottom: 2px solid #d9d9d9;
    padding: 10px;

    @media only screen and (max-width: 480px) {
        flex-direction: column;
        gap: 10px;
    }
}

.listing-title-text {
    margin-top: 10px;
    margin-bottom: 20px;

    font-size: 30px;
    font-weight: 700;

    @media only screen and (max-width: 480px) {
        font-size: 24px;
        font-weight: 700;
    }
}

.listing-title-desc {
    @media only screen and (max-width: 480px) {
        font-size: 20px;
        font-weight: 400;
    }
}

.listing-contact {
    margin-top: 20px;

    @media only screen and (max-width: 480px) {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
}

.listing-contact-p {
    border-bottom: 2px solid #d9d9d9;
    padding-bottom: 10px;

}

.listing-contact-p-t {
    border-bottom: 2px solid #d9d9d9;
    padding-bottom: 10px;
    padding-top: 20px;
}

.listing-contact-info {
    display: flex;
    align-items: center;
    gap: 10px;

    margin-top: 10px;

    @media only screen and (max-width: 480px) {
        font-size: 18px;
        font-weight: 400;
        flex-direction: column;
        text-align: center;
    }
}

.listing-info-tag {
    display: flex;
    align-items: center;
    gap: 10px;
    
    margin-top: 20px;
    margin-bottom: 10px;
}

.listing-info-tag-link {
    padding: 5px 10px;
    border-radius: 10px;
    background-color: #76adcf;
}

.show-edit-delete {
    display: flex;
    align-items: center;
    gap: 30px;
}

.show-edit-link {
    padding: 10px;
    background-color: rgb(29, 237, 50);

    font-weight: 600;

    border-radius: 10px;

    &:hover {
        background-color: rgb(0, 185, 19);
    }
}

.show-delete-btn {
    padding: 10px;
    background-color: rgb(237, 29, 29);
    color: #404040;


    font-weight: 600;

    border-radius: 10px;

    &:hover {
        background-color: rgb(255, 88, 88);
    }
}

.show-listing-approved {
    display: flex;
    align-items: center;
    justify-content: space-between;

    background-color: #000d48;
    color: #ffffff;
    padding: 20px;
    margin-top: 30px;

    border-radius: 15px;

    button {
        background-color: #686868;
        padding: 5px;
        border-radius: 10px;

        &:hover {
            background-color: #a9a9a9;
            color: #000;
        }
    }

    @media only screen and (max-width: 480px) {
        flex-direction: column;
        gap: 20px;

        font-size: 20px;
    }
}
</style>