<script setup>
import PaginationLinks from "../../Components/PaginationLinks.vue";
import RoleSelect from "../../Components/RoleSelect.vue";
import SessionMessages from "../../Components/SessionMessages.vue";
import InputField from "../../Components/InputField.vue";
import { router, useForm } from "@inertiajs/vue3";

defineProps({ 
    users: Object,
    status: String, 
});

const params = route().params;

const form = useForm({
    search: params.search,
});

const search = () => {
    router.get(route("admin.index"), {
        search: form.search,
        user_role: params.user_role,
    });
};

const toggleRole = (e) => {
    if (e.target.checked) {
        router.get(
            route("admin.index", {
                search: params.search,
                user_role: "suspended",
            })
        );
    } else {
        router.get(
            route("admin.index", {
                search: params.search,
                user_role: null,
            })
        );
    }
};
</script>

<template>
    <Head title="- Админ" />

    <SessionMessages :status="status" />

    <!-- Heading -->
    <div class="admin-search">
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
                :href="route('admin.index', { ...params, search: null, page: null })"
            >
                {{ params.search }}
                <i class="icon-close"></i>
            </Link>
        </div>

        <div
            class="admin-checkbox"
        >
            <input
                @input="toggleRole"
                :checked="params.user_role"
                type="checkbox"
                id="toggleRole"
                class="admin-checkbox-input"
            />
            <label
                for="toggleRole"
                class="admin-checkbox-label"
            >
                Заблокированные пользователи
            </label>
        </div>
    </div>

    <!-- Table -->
    <table
        class="admin-table"
    >
        <thead>
            <tr class="admin-thead">
                <th class="tr-admin-1">Имя</th>
                <th class="tr-admin-2">Роль</th>
                <th class="tr-admin-3">Запись</th>
                <th class="tr-admin-4">Вид</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="user in users.data" :key="user.id">
                <td class="tr-admin-1">
                    <p class="tr-admin-1-name">{{ user.name }}</p>
                    <p class="tr-admin-1-email">{{ user.email }}</p>
                </td>

                <td class="tr-admin-2">
                    <RoleSelect :user="user" />
                </td>

                <td class="tr-admin-3">
                    <div class="admin-approved">
                        <div class="admin-approved-1">
                            <p>
                                {{
                                    user.listings.filter((l) => l.approved)
                                        .length
                                }}
                            </p>
                            <i
                                class="icon-approved"
                            ></i>
                        </div>
                        <div class="admin-approved-1">
                            <p>
                                {{
                                    user.listings.filter((l) => !l.approved)
                                        .length
                                }}
                            </p>
                            <i
                                class="icon-pending-approval"
                            ></i>
                        </div>
                    </div>
                </td>

                <td class="tr-admin-4">
                    <Link 
                        class="icon-link"
                        :href="route('user.show', user.id)"
                    ></Link>
                </td>
            </tr>
        </tbody>
    </table>

    <div>
        <PaginationLinks :paginator="users" />
    </div>
</template>

<style lang="scss">
.admin-table {
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
                padding-bottom: 10px;
            }
        }
    }
            
}

.admin-thead {
    text-transform: uppercase;
}

.tr-admin-1 {
    width: 50%;
    text-align: left;

    @media only screen and (max-width: 480px) {
        width: 40%;

        font-weight: 300;
        font-size: 18px;
        word-break: break-all;
    }
}

.tr-admin-2 {
    width: 30%;
    text-align: left;

    @media only screen and (max-width: 480px) {
        width: 20%;

        font-weight: 300;
        font-size: 18px;
        word-break: break-all;


        select {
            width: 50px;
        }
    }
}

.tr-admin-3 {
    width: 15%;
    text-align: left;

    @media only screen and (max-width: 480px) {
        width: 20%;

        font-weight: 300;
        font-size: 18px;
        word-break: break-all;

    }
}

.tr-admin-4 {
    width: 15%;
    text-align: left;

    button {
        color: #c30000;
    }

    @media only screen and (max-width: 480px) {
        width: 20%;

        font-weight: 300;
        font-size: 18px;
    }
}

.admin-approved {
    display: flex;
    align-items: center;
    gap: 50px;

    @media only screen and (max-width: 480px) {
        flex-direction: column;
    }
}

.admin-approved-1 {
    display: flex;
    align-items: center;
    gap: 10px;
}

.tr-admin-1-name {
    font-weight: 600;
}

.tr-admin-1-email {
    font-size: 18px;
}

.admin-search {
    display: flex;
    align-items: center;
    justify-content: space-between;

    @media only screen and (max-width: 480px) {
        flex-direction: column;
    }
}

.admin-search-input {
    display: flex;
    align-items: center;
    gap: 20px;

    @media only screen and (max-width: 480px) {
        flex-direction: column;
        gap: 0px;
    }
}

.admin-input {
    margin-top: 30px;
    margin-bottom: 30px;
}

.admin-checkbox {
    display: flex;
    align-items: center;
    gap: 10px;

    padding: 5px;
    border-radius: 10px;

    &:hover {
        background-color: #c3c3c3;
        color: #000;
    }
}

.admin-checkbox-input {
    cursor: pointer;
}

.admin-checkbox-label {
    display: block;
    cursor: pointer;

    @media only screen and (max-width: 480px) {
        font-size: 18px;
    }
}
</style>