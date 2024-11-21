<script setup>
import Title from '../Components/Title.vue';
import PaginationLinks from "../Components/PaginationLinks.vue";
import SessionMessages from "../Components/SessionMessages.vue";
import ContainerWrapper from '../Components/ContainerWrapper.vue';
import { router } from "@inertiajs/vue3";

defineProps({
    listings: Object,
    status: String,
})

const deleteListing = (id) => {
    if (confirm("Вы уверены?")) {
        router.delete(route('listing.destroy', id))
    };
};
</script>

<template>
    <Head title="- Панель" />

    <SessionMessages class="session-dashboard" :status="status"/>

    <div v-if="listings">
        <div v-if="Object.keys(listings.data).length">
            <div>
                <div class="title-dashboard">
                    <Title>Ваши последние объявления</Title>

                    <div class="dashboard-approved">
                        <p class="icon-approved-green">
                            Одобренный
                            <i class="icon-approved"></i>
                        </p>

                        <p class="icon-pending-approval-reed">
                            Ожидающее утверждения
                            <i class="icon-pending-approval"></i>
                        </p>
                    </div>
                </div>

                <table class="table-dashboard">
                    <thead
                        class="thead-dashboard"
                    >
                        <tr>
                            <th class="tr-dashboard-1">Название</th>

                            <th class="tr-dashboard-2">Вид</th>
                            <th class="tr-dashboard-3">Редакт</th>
                            <th class="tr-dashboard-4">Удалить</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="listing in listings.data"
                            :key="listing.id"
                            class="tbody-tr-dashboard"
                        >
                            <td class="tr-dashboard-1">
                                <div class="tr-dashboard-1-img">
                                    <img
                                        :src="
                                            listing.image
                                                ? `/storage/${listing.image}`
                                                : '/storage/images/listing/default.jpeg'
                                        "
                                        alt=""
                                    />
                                    <h4 class="h4-td-dashboard">
                                        {{ listing.title }}
                                        <i
                                            :class="`icon-${
                                                listing.approved
                                                    ? 'approved'
                                                    : 'pending-approval'
                                            }`"
                                        ></i>
                                    </h4>
                                </div>
                            </td>

                            <td
                                class="tr-dashboard-2"
                            >
                                <Link
                                    v-if="listing.approved"
                                    :href="route('listing.show', listing.id)"
                                    >Вид</Link
                                >
                            </td>

                            <td
                                class="tr-dashboard-3"
                            >
                                <Link :href="route('listing.edit', listing.id)"
                                    >Редакт</Link
                                >
                            </td>

                            <td class="tr-dashboard-4">
                                <button type="button" @click="deleteListing(listing.id)">
                                    Удалить
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <PaginationLinks :paginator="listings" />
            </div>
        </div>

        <div v-else>
            <ContainerWrapper>
                У вас нет объявлений!
            </ContainerWrapper>
        </div>
    </div>

    <div v-else>
        Из-за нарушения наших условий ваш аккаунт был заблокирован, пожалуйста
        свяжитесь с нами по <span class="suspended-span">email@admin.com</span>
    </div>
</template>

<style  lang="scss">
.session-dashboard {
    margin-top: 25px;

    @media only screen and (max-width: 480px) {
        margin-top: 0px;
    }
}

.title-dashboard {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-top: 30px;

    font-size: 18px;
    font-weight: 400;

    @media only screen and (max-width: 480px) {
        flex-direction: column;
        margin-top: 10px;
    }
}

.dashboard-approved {
    display: flex;
    align-items: center;
    gap: 40px;

    @media only screen and (max-width: 480px) {
        flex-direction: column;
        gap: 10px;
        padding-bottom: 10px;
    }
}

.suspended-span {
    color: #8804da;
}

.icon-approved-green {
    display: flex;
    align-items: center;
    gap: 10px;
}

.icon-pending-approval-reed {
    display: flex;
    align-items: center;
    gap: 10px;
}

.table-dashboard {
    width: 100%;
    overflow: hidden;
    table-layout: fixed;
    border-spacing: 0 20px;

    padding: 10px;

    box-shadow: 5px 10px 15px 0 #c9c9c9;
    border: 2px solid #d9d9d9;
    border-radius: 10px;

    thead {
        tr {
            th {
                border-bottom: 1px dashed #d9d9d9;
                padding-bottom: 10px;
            }
        }
    }

    tbody {
        tr {
            td {
                border-bottom: 1px dashed #d9d9d9;
                padding: 10px;
            }
        }
    }

    @media only screen and (max-width: 480px) {
        thead {
            tr {
                th {
                    font-weight: 500;
                    font-size: 12px;
                }
            }
        }

        tbody {
            tr {
                td {
                    padding: 5px;
                }
            }
        }
    }
}

.thead-dashboard {
    text-transform: uppercase;
}

.tr-dashboard-1 {
    width: 60%;
    text-align: left;

    @media only screen and (max-width: 480px) {
        width: 40%;

        font-weight: 300;
        font-size: 18px;
    }
}

.tr-dashboard-2 {
    width: 10%;
    text-align: left;

    @media only screen and (max-width: 480px) {
        width: 20%;

        font-weight: 300;
        font-size: 18px;
    }
}

.tr-dashboard-3 {
    width: 15%;
    text-align: left;

    @media only screen and (max-width: 480px) {
        width: 20%;

        font-weight: 300;
        font-size: 18px;
        word-break: break-all;
    }
}

.tr-dashboard-4 {
    width: 15%;
    text-align: left;

    button {
        color: #c30000;
    }

    @media only screen and (max-width: 480px) {
        width: 20%;

        font-weight: 300;
        font-size: 18px;
        word-break: break-all;
    }
}

.tbody-tr-dashboard {
    border-bottom: 2px solid #d9d9d9; 
}

.tr-dashboard-1-img {
    display: flex;
    align-items: center;
    gap: 20px;

    img {
        height: 50px;
        width: 50px;

        border-radius: 50%;
        object-fit: cover;
        object-position: center;
    }

    @media only screen and (max-width: 480px) {
        flex-direction: column;
        word-break: break-all;
        gap: 5px;

        img {
            height: 30px;
            width: 30px;
        }
    }
}

.h4-td-dashboard {
    display: flex;
    align-items: center;
    gap: 10px;

    i {
        width: 30px;
        height: 30px;
    }

    @media only screen and (max-width: 480px) {
        flex-direction: column;
        font-weight: 600;
    }
}
</style>