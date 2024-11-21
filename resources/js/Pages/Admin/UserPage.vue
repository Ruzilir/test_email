<script setup>
import { router, useForm } from "@inertiajs/vue3";
import Title from "../../Components/Title.vue";
import InputField from "../../Components/InputField.vue";
import PaginationLinks from "../../Components/PaginationLinks.vue";
import SessionMessages from "../../Components/SessionMessages.vue";

const props = defineProps({
    user: Object,
    listings: Object,
    status: String,
});

const params = route().params;
const form = useForm({ search: params.search });

const search = () => {
    router.get(
        route("user.show", {
            user: props.user.id,
            search: form.search,
            disapproved: params.disapproved
        })
    );
};

const showDisapproved = (e) => {
    if (e.target.checked) {
        router.get(
            route("user.show", {
                user: props.user.id,
                search: params.search,
                disapproved: true,
            })
        );
    } else {
        router.get(
            route("user.show", {
                user: props.user.id,
                search: params.search,
                disapproved: null,
            })
        );
    }
};

const toggleApprove = (listing) => {
    let msg = listing.approved
        ? "Отклонить это объявление?"
        : "Одобрить это объявление?";

    if (confirm(msg)) {
        router.put(route("admin.approve", listing.id));
    }
};
</script>

<template>
    <Head :title="`- ${user.name} Listings`" />

    <SessionMessages :status="status" />

    <!-- Heading -->
    <div>
        <Title class="mob-user-page">Последние объявления {{ user.name }}</Title>
        <div class="search-toggle">
            <div class="admin-search-input">
                <form @submit.prevent="search">
                    <InputField
                        label=""
                        type="search"
                        icon="search"
                        placeholder="Поиск..."
                        v-model="form.search"
                        class="admin-input"
                    />
                </form>

                <Link 
                    class="filter-tag-link"
                    v-if="params.search" 
                    :href="
                        route('user.show', { 
                            ...params, 
                            search: null, 
                            page: null, 
                            user: user.id,
                        })
                    "
                >
                    {{ params.search }}
                    <i class="icon-close"></i>
                </Link>
            </div>

            <div
                class="admin-checkbox"
            >
                <input
                    @input="showDisapproved"
                    :checked="params.disapproved"
                    type="checkbox"
                    id="showDisapproved"
                    class="admin-checkbox-input"
                />
                <label
                    for="showDisapproved"
                    class="admin-checkbox-label"
                >
                    Не одобренные списки
                </label>
            </div>
        </div>
    </div>

    <table
        class="admin-table"
    >
        <thead>
            <tr class="admin-thead">
                <th class="tr-admin-1">Название</th>
                <th class="tr-admin-2">Одобренный</th>
                <th class="tr-admin-3">Вид</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="listing in listings.data" :key="listing.id">
                <td class="tr-admin-1">
                    {{ listing.title }}
                </td>

                <td class="tr-admin-2">
                    <button @click.prevent="toggleApprove(listing)">
                        <i
                            :class="`icon-${
                                listing.approved
                                    ? 'approved'
                                    : 'pending-approval'
                            }`"
                        ></i>
                    </button>
                </td>

                <td class="tr-admin-3">
                    <Link
                        :href="route('listing.show', listing.id)"
                        class="icon-link"
                    ></Link>
                </td>
            </tr>
        </tbody>
    </table>

    <div>
        <PaginationLinks :paginator="listings" />
    </div>
</template>

<style lang="scss">
.search-toggle {
    display: flex;
    align-items: center;
    justify-content: space-between;

    @media only screen and (max-width: 480px) {
        flex-direction: column;
    }
}

.mob-user-page {
    @media only screen and (max-width: 480px) {
        padding: 0px;
        margin-top: 20px;
    }
}
</style>