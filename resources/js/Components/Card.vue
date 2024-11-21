<script setup>
import { router } from '@inertiajs/vue3';

const params = route().params;

defineProps({
    listing: Object,
});

const selectUser = (id) => {
    router.get(route("home"), {
        user_id: id,
        search: params.search,
        tag: params.tag,
    });
};
</script>

<template>
    <div class="card">
        <div>
            <Link :href="route('listing.show', listing.id)">
                <img 
                    class="card-image" 
                    :src="listing.image
                    ? `/storage/${listing.image}`
                    : '/storage/images/listing/default.jpeg'
                    " 
                    alt="image"
                >
            </Link>

            <div class="card-text">
                <h3>
                    {{ listing.title.substring(0, 15) }}...
                </h3>

                <p class="card-text-desc">
                    {{ listing.desc.substring(0, 50) }}...
                </p>

                <p class="card-text-price">
                    {{ listing.price }} &#8381;
                </p>

                <Link :href="route('listing.show', listing.id)">
                    Подробнее
                </Link>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    overflow: hidden;

    border-radius: 10px;
    border: 2px solid #d9d9d9;
    box-shadow: 5px 10px 15px 0 #c9c9c9;

    // transition: transform 0.3s ease;

    &:hover {
        // transform: scale(1.05);
        border: 2px solid #000000;
    }
}

.card-image {
    height: 350px;
    width: 100%;
    background-color: rgb(126, 113, 126);

    object-fit: cover;
    object-position: center;

    @media only screen and (max-width: 480px) {
        height: 160px;
    }
}

.card-text {
    display: flex;
    flex-direction: column;
    gap: 10px;

    margin: 20px;

    h3 {
        font-weight: 800;
        margin-bottom: 10px;
    }

    button {
        font-weight: 700;
        color: #b463ff;

        text-decoration: underline;
    }

    a {
        background-color: #76adcf;
        color: #181818;

        text-align: center;

        padding: 10px;
        border-radius: 10px;

        font-size: 28px;
        font-weight: 500;

        &:hover {
            background-color: #8ed0f9;
            color: #ffffff;
        }

        @media only screen and (max-width: 480px) {
        font-size: 18px;
        }
    }

    @media only screen and (max-width: 480px) {
        font-size: 18px;
        margin: 10px;

        h3 {
            margin-bottom: 0;

            height: 40px;
        }
    }
}

.card-text-price {
    font-size: 26px;
    font-weight: 600;

    background-color: #c4c4c4;
    color: #181818;
    border-radius: 10px;
    width: 50%;
    text-align: center;
    padding: 5px;

    @media only screen and (max-width: 480px) {
        font-size: 18px;
    }
}

.card-text-desc {
    font-size: 18px;
    word-break: break-all;

    @media only screen and (max-width: 480px) {
        font-size: 12px;
        height: 40px;
    }
}

.tags-btn {
    color: #000;
    background-color: #76adcf;
    padding: 3px 5px;
    border-radius: 15px;

    font-size: 20px;
    font-weight: 600;

    &:hover {
        background-color: #bee6ff;
    }
}

.tags-card {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;

    margin: 20px;
}
</style>