<script setup>
import { usePage } from '@inertiajs/vue3';
import Container from '../../Components/Container.vue';
import NavLink from '../../Components/NavLink.vue';
import { switchTheme } from '../../theme';
import { computed, ref } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

const show = ref(false);
const showMob = ref(false);
</script>

<template>
    <div v-show="show" @click="show = false" class="show"></div>

    <div v-show="showMob" @click="showMob = false" class="show"></div>

    <header class="mob-header">
        <Container class="header">
            <nav class="nav">
                <div class="nav-logo">
                    <div class="logo">
                        <div>
                            <i class="icon-logo"></i>
                        </div>

                        <div>
                            CHAFFER
                        </div>
                    </div>

                    <div class="reg-theme">
                        <!------- Auth ------->
                        <div v-if="user" class="select-menu">
                            <div 
                                @click="show = !show" 
                                class="down"
                                :class="{ 'down-select' : show }"
                            >
                                <p>{{ user.name }}</p>
                                <i class="icon-down"></i>
                            </div>

                            <Link 
                                v-if="user.role === 'admin'"
                                :href="route('admin.index')" 
                                class="theme"
                            >
                                <i class="icon-lock"></i>
                            </Link>

                            <!------- User dropdown menu ------->
                            <div 
                                v-show="show" 
                                @click="show=false"
                                class="menu-user"
                            >
                                <Link 
                                    :href="route('listing.create')"
                                    class="menu-link"
                                >
                                    Запись
                                </Link>

                                <Link 
                                    :href="route('profile.edit')"
                                    class="menu-link"
                                >
                                    Профиль
                                </Link>

                                <Link 
                                    :href="route('dashboard')"
                                    class="menu-link"
                                >
                                    Панель
                                </Link>

                                <Link 
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                    class="menu-link"
                                >
                                    Выход
                                </Link>
                            </div>
                        </div>

                        <!------- Guest ------->
                        <div v-else>
                            <Link 
                                :href="route('login')" 
                                class="mob-login"
                            >
                                <i class="icon-login"></i>
                            </Link>

                            <NavLink 
                                routeName="login" 
                                componentName="Auth/Login"
                                class="pc-login"
                            >
                                Вход
                            </NavLink>
                        </div>

                        <button @click="switchTheme" class="theme">
                            <i class="icon-theme"></i>
                        </button>
                    </div>   
                </div>

                <div class="link">
                    <NavLink routeName="home" componentName="Home">Главная</NavLink>
                    
                    <NavLink routeName="company" componentName="InfoCompany">О компании</NavLink>

                    <NavLink routeName="client" componentName="InfoClient">Для клиента</NavLink>

                    <NavLink routeName="contact" componentName="InfoContact">Контакты</NavLink>
                </div>

                <div @click="showMob = !showMob" class="mob-menu">
                    <i class="icon-menu"></i>
                </div>
                
                <div @click="showMob = !showMob" v-show="showMob" class="mob-link">
                    <NavLink routeName="home" componentName="Home">Главная</NavLink>
                    
                    <NavLink routeName="company" componentName="InfoCompany">О компании</NavLink>

                    <NavLink routeName="client" componentName="InfoClient">Для клиента</NavLink>

                    <NavLink routeName="contact" componentName="InfoContact">Контакты</NavLink>
                </div>
            </nav>
        </Container>
    </header>
</template>

<style lang="scss">
.mob-header {
    @media only screen and (max-width: 480px) {
        padding: 0 5px;
    }
}

.show {
    position: fixed;
    inset: 0px;
    z-index: 10;
}

.header {
    display: grid;

    padding: 10px 0;
    margin-top: 10px;
    border: 2px solid #d9d9d9;
    border-radius: 10px;

    box-shadow: 5px 10px 15px 0 #c9c9c9;
}

.nav-logo {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding-bottom: 10px;

    @media only screen and (max-width: 480px) {
        border-bottom: 2px solid #d9d9d9;
        margin-bottom: 10px;
    }
}

.nav {
    position: relative;
    padding: 0 30px;

    @media only screen and (max-width: 480px) {
        padding: 0 10px;
    }
}

.logo {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;

    font-size: 16px;
    font-weight: 700;
}

.link {
    display: flex;
    gap: 50px;

    padding: 20px 0 10px 0;
    border-top: 2px solid #d9d9d9;

    @media only screen and (max-width: 480px) {
        display: none;
    }
}

.reg-theme {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.theme {
    display: grid;
    place-items: center;
    border-radius: 50%;
    height: 30px;
    width: 30px;

    &:hover {
        border: 2px solid #848484;
    }
}

.down {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;

    margin-right: 10px;
    padding: 5px 10px;
    border-radius: 10px;

    &:hover {
        color: #494949;
        background-color: #e2e2e2;
    }
}

.down-select {
    color: #494949;
    background-color: #e2e2e2;
}

.select-menu {
    position: relative;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
}

.menu-user {
    display: flex;
    flex-direction: column;
    align-items: start;

    position: absolute;
    left: -30px;
    top: 50px;
    z-index: 20;

    border-radius: 10px;
    border: 2px solid #d9d9d9;
    padding: 10px;

    a {
        color: #848484;
        padding: 5px 10px;
        margin: 5px;
        border-radius: 10px;

        &:hover {
            color: #494949;
            background-color: #e2e2e2;
        }
    }

    button {
        color: #848484;
        padding: 5px 10px;
        margin: 5px;
        border-radius: 10px;

        font-weight: 500;
        font-size: 24px;

        &:hover {
            color: #494949;
            background-color: #e2e2e2;
        }
    }
}

.mob-login {
    display: none;
    margin-right: 10px;

    @media only screen and (max-width: 480px) {
        display: block;
    }
}

.pc-login {
    @media only screen and (max-width: 480px) {
        display: none;
    }
}

.mob-link {
    display: flex;
    flex-direction: column;
    align-items: start;

    position: absolute;
    left: 10px;
    top: 100px;
    z-index: 20;

    border-radius: 10px;
    border: 2px solid #d9d9d9;
    padding: 10px;
    background-color: #ffffff;

    a {
        color: #848484;
        padding: 5px 10px;
        margin: 5px;
        border-radius: 10px;
    }

    button {
        color: #848484;
        padding: 5px 10px;
        margin: 5px;
        border-radius: 10px;

        font-weight: 500;
        font-size: 24px;
    }
}

.mob-menu {
    display: none;

    @media only screen and (max-width: 480px) {
        display: block;
    }
}
</style>