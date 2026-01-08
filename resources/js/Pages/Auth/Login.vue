<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <div v-if="status" class="mb-4">
        {{ status }}
    </div>
    <div class="container" >
        <div class="form-container">
            <h3 class="title">Authentification</h3>
            <form class="form-horizontal" @submit.prevent="submit">
                <div class="form-icon">
                    <div class="image-container">
                    <img src="/images/logo/logoTarbi.png" alt="Votre image">
                </div>
            </div>
            <div class="form-group">
                <span class="input-icon"><i class="fa fa-user"></i></span>
                <input type="text" id="email" v-model="form.email" class="form-control" placeholder="Utilisateur">
                <InputError class="mt-2" :message="form.errors.email" />

            </div>
            <div class="form-group">
                <span class="input-icon"><i class="fa fa-lock"></i></span>
                <input type="password" id="password" v-model="form.password" autocomplete="current-password"
                    class="form-control" placeholder="Mot de passe">
                    <InputError class="mt-2" :message="form.errors.password" />

                    <!-- <span class="forgot"><a href="">Mot de passe oublié</a></span> -->
            </div>
            <div class="form-group">
                <Checkbox v-model:checked="form.remember" name="remember" class="custom-control-input"
                    id="customCheck1" />
                <label class="custom-control-label" for="customCheck1">Garder la session</label>
            </div>

            <button :disabled="form.processing" class="btn signin">Connection</button>
            <div v-if="status" class="mb-4">
                {{ status }}
            </div>
        </form>
    </div>
</div>
<!-- <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div v-if="status" class="mb-4">
            {{ status }}
        </div>

        <div class="sign-in-from">
            <h1 class="mb-0">Authentification</h1>
            <p></p>
            <form class="mt-4" @submit.prevent="submit">
                <div class="form-group">
                    <label for="email" value="Email">Adresse Email</label>
                    <input id="email" v-model="form.email" type="email" class="form-control mb-0" autocomplete="username"
                        placeholder="Enter email" required autofocus />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="form-group">
                    <label for="password" value="Password">Mot de passe</label>
                    <Link v-if="canResetPassword" :href="route('password.request')" class="float-right">
                    Mot de passe oublié ?
                    </Link>
                    <input id="password" v-model="form.password" type="password" autocomplete="current-password"
                        class="form-control mb-0" placeholder="Password" required />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
                <div class="d-inline-block w-100">
                    <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                        <Checkbox v-model:checked="form.remember" name="remember" class="custom-control-input"
                                    id="customCheck1" />
                                <label class="custom-control-label" for="customCheck1">Garder la session</label>
                            </div>
                            <button class="btn btn-primary float-right" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Connection
                            </button>
                        </div>
                        <div class="sign-info">
                            <ul class="iq-social-media">
                                <li>
                                    <a href="#"><i class="ri-facebook-box-line"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="ri-twitter-line"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="ri-instagram-line"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div v-if="status" class="mb-4">
                            {{ status }}
                        </div>
                    </form>
                </div>
            </AuthenticationCard> -->
</template>
<style>


.container {
    margin: auto;
    border-radius: 1px;
}

.form-container {
    background: linear-gradient(150deg, #f563a2 50%, #a6a6a6 34%);
    font-family: 'Raleway', sans-serif;
    text-align: center;
    padding: 30px 20px 50px;
    max-width: 400px;
    margin: auto;
    margin-top: 120px;
}

.form-container .title {
    color: #fff;
    font-size: 23px;
    text-transform: capitalize;
    letter-spacing: 1px;
    margin: 0 0 60px;
}

.form-container .form-horizontal {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
}

.form-horizontal .form-icon {
    color: #fff;
    background-color: #ffffff;
    font-size: 75px;
    line-height: 92px;
    height: 90px;
    width: 90px;
    margin: -65px auto 10px;
    border-radius: 50%;
}

.form-horizontal .form-group {
    margin: 0 0 10px;
    position: relative;
}

.form-horizontal .form-group:nth-child(3) {
    margin-bottom: 30px;
}

.form-horizontal .form-group .input-icon {
    color: #0b0b0b;
    font-size: 23px;
    position: absolute;
    left: 0;
    top: 10px;
    margin-left: 6px;
}

.form-horizontal .form-control {
    color: #000;
    font-size: 16px;
    font-weight: 600;
    height: 50px;
    padding: 10px 10px 10px 40px;
    margin: 0 0 5px;
    border: none;
    border-bottom: 2px solid #e7e7e7;
    border-radius: 0px;
    box-shadow: none;
}

.form-horizontal .form-control:focus {
    box-shadow: none;
    border-bottom-color: #EC5F20;
}

.form-horizontal .form-control::placeholder {
    color: #000;
    font-size: 16px;
    font-weight: 600;
}

.form-horizontal .forgot {
    font-size: 13px;
    font-weight: 600;
    text-align: right;
    display: block;
}

.form-horizontal .forgot a {
    color: #777;
    transition: all 0.3s ease 0s;
}

.form-horizontal .forgot a:hover {
    color: #777;
    text-decoration: underline;
}

.form-horizontal .signin {
    color: #fff;
    background-color: #f563a2;
    font-size: 17px;
    text-transform: capitalize;
    letter-spacing: 2px;
    width: 100%;
    padding: 12px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    transition: all 0.4s ease 0s;
}

.form-horizontal .signin:hover,
.form-horizontal .signin:focus {
    font-weight: 600;
    letter-spacing: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3) inset;
}

.image-container {
    width: 100px;
    /* Définir la largeur souhaitée pour votre conteneur d'image */
    height: 90px;
    /* Définir la hauteur souhaitée pour votre conteneur d'image */
    border-radius: 20%;
    /* Appliquer la forme circulaire */
    overflow: hidden;
    /* Cacher le contenu en dehors du cercle */
}

.image-container img {
    width: 50%;
    /* Pour que l'image remplisse complètement le conteneur circulaire */
    height: 50%;
    /* Pour que l'image remplisse complètement le conteneur circulaire */
    object-fit: cover;
    /* Ajuster la taille de l'image pour qu'elle couvre complètement le conteneur */
}</style>
