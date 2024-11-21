<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({ user: Object });

const form = useForm({ role: props.user.role });

const submit = () => {
    if (confirm(`Измените роль этого пользователя на ${form.role}?`)) {
        form.put(route("admin.role", props.user.id));
    } else {
        form.role = props.user.role;
    }
};
</script>

<template>
    <div class="role">
        <form @change="submit" class="role-form">
            <select
                v-model="form.role"
                name="roles"
            >
                <option value="admin">Админ</option>

                <option value="general">Общий</option>

                <option value="suspended">Приостановлен</option>
            </select>
        </form>
    </div>
</template>

<style lang="scss">
.role {
    display: flex;
    align-items: center;
    gap: 20px;
}

.role-form {
    display: flex;
    align-items: center;
    gap: 20px;

    select {
        border-radius: 10px;
        border: 2px solid #d9d9d9;
    }

    option {
        color: #000;
    }
}
</style>