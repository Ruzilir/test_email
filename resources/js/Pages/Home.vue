<script setup>
import Card from '../Components/Card.vue';
import PaginationLinks from '../Components/PaginationLinks.vue';
import ContainerWrapper from '../Components/ContainerWrapper.vue';
import Advertising from '../Components/Advertising.vue';
import InputField from '../Components/InputField.vue';
import { router, useForm } from '@inertiajs/vue3';

const params = route().params;

const props = defineProps({
    listings: Object,
    searchTerm: String,
});

const username = params.user_id ? props.listings.data.find(i => i.user_id === Number(params.user_id)).user.name : null;

const form = useForm({
    search: props.searchTerm,
});

const search = () => {
    router.get(route("home"), { 
        search: form.search, 
        user_id: params.user_id,
        tag: params.tag,
    });
};
</script>

<template>
    <Head title="- Главная" />

    <Advertising />

    <ContainerWrapper class="filter">
        <div class="filter-tag">
            <Link 
                class="filter-tag-link"
                v-if="params.tag" 
                :href="route('home', { ...params, tag: null, page: null })"
            >
                {{ params.tag }}
                <i class="icon-close"></i>
            </Link>
            
            <Link 
                class="filter-tag-link"
                v-if="params.search" 
                :href="route('home', { ...params, search: null, page: null })"
            >
                {{ params.search }}
                <i class="icon-close"></i>
            </Link>
            
            <Link 
                class="filter-tag-link"
                v-if="params.user_id" 
                :href="route('home', { ...params, user_id: null, page: null })"
            >
                {{ username }}
                <i class="icon-close"></i>
            </Link>
        </div>

        <div>
            <form @submit.prevent="search">
                <InputField
                    type="search"
                    label=""
                    icon="search"
                    placeholder="Поиск..."
                    v-model="form.search"
                />
            </form>
        </div>
    </ContainerWrapper>

    <div v-if="Object.keys(listings.data).length">
        <div class="listing">
            <div v-for="listing in listings.data" :key="listing.id">
                <Card :listing="listing" />
            </div>
        </div>

        <div>
            <PaginationLinks :paginator="listings" />
        </div>
    </div>

    <div v-else>
        <ContainerWrapper>
            Здесь нет объявлений
        </ContainerWrapper>
    </div>
</template>

<style lang="scss">
.listing {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;

    margin-top: 30px;

    @media only screen and (max-width: 480px) {
        grid-template-columns: repeat(2, 1fr);
        margin-top: 20px;
        gap: 10px;
    }
}

.filter {
    display: flex;
    justify-content: space-between;
    align-items: center;

    @media only screen and (max-width: 480px) {
        flex-direction: column;
        gap: 10px;
    }
}

.filter-tag {
    display: flex;
    align-items: center;
    gap: 20px;
}

.filter-tag-link {
    display: flex;
    align-items: center;
    gap: 10px;
    
    padding: 5px 10px;
    border-radius: 10px;
    background-color: #76adcf;
}
</style>