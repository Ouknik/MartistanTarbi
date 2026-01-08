<script setup>
import { useForm, Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import InputError from '@/Components/InputError.vue';
import Checkbox from '@/Components/Checkbox.vue';

const page = usePage();
const translations = computed(() => page.props.translations || {});
const locale = computed(() => page.props.locale || 'ar');
const isRtl = computed(() => locale.value === 'ar');
const supportedLocales = computed(() => page.props.supportedLocales || { ar: 'العربية', en: 'English', fr: 'Français' });

// Translation helper
const t = (key) => translations.value[key] || key.split('.').pop();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('superadmin.login.submit'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head :title="t('superadmin.login_title')" />
    
    <div class="login-wrapper" :dir="isRtl ? 'rtl' : 'ltr'">
        <!-- Language Switcher -->
        <div class="lang-switcher">
            <a 
                v-for="(name, code) in supportedLocales" 
                :key="code"
                :href="`/superadmin/locale/${code}`"
                :class="['lang-btn', locale === code ? 'active' : '']"
            >
                {{ name }}
            </a>
        </div>

        <div class="container">
            <div class="form-container">
                <h3 class="title">{{ t('superadmin.system_admin_panel') }}</h3>
                <form class="form-horizontal" @submit.prevent="submit">
                    <div class="form-icon">
                        <div class="image-container">
                            <svg class="admin-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="input-icon"><i class="fa fa-user"></i></span>
                        <input 
                            type="email" 
                            id="email" 
                            v-model="form.email" 
                            class="form-control" 
                            :placeholder="t('superadmin.email')"
                            required
                            autofocus
                        >
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="form-group">
                        <span class="input-icon"><i class="fa fa-lock"></i></span>
                        <input 
                            type="password" 
                            id="password" 
                            v-model="form.password" 
                            autocomplete="current-password"
                            class="form-control" 
                            :placeholder="t('superadmin.password')"
                            required
                        >
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    <div class="form-group checkbox-group">
                        <Checkbox 
                            v-model:checked="form.remember" 
                            name="remember" 
                            class="custom-control-input"
                            id="customCheck1" 
                        />
                        <label class="custom-control-label" for="customCheck1">{{ t('superadmin.remember_me') }}</label>
                    </div>

                    <button :disabled="form.processing" class="btn signin">
                        <span v-if="form.processing" class="spinner"></span>
                        {{ form.processing ? t('superadmin.logging_in') : t('superadmin.login') }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <p class="footer-text">
            © {{ new Date().getFullYear() }} مريستان SaaS - {{ t('superadmin.copyright') }}
        </p>
    </div>
</template>

<style scoped>
.login-wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f563a2 0%, #d64d8a 50%, #a6a6a6 100%);
    padding: 20px;
}

.lang-switcher {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.lang-btn {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.lang-btn:hover {
    background: rgba(255, 255, 255, 0.3);
}

.lang-btn.active {
    background: white;
    color: #f563a2;
    font-weight: bold;
}

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
    border-radius: 10px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
}

.form-container .title {
    color: #fff;
    font-size: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 0 0 60px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.form-container .form-horizontal {
    background-color: #fff;
    padding: 25px;
    border-radius: 10px;
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
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-container {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.admin-icon {
    width: 50px;
    height: 50px;
    color: #f563a2;
}

.form-horizontal .form-group {
    margin: 0 0 15px;
    position: relative;
}

.form-horizontal .form-group:nth-child(3) {
    margin-bottom: 25px;
}

.form-horizontal .form-group .input-icon {
    color: #f563a2;
    font-size: 20px;
    position: absolute;
    left: 0;
    top: 12px;
    margin-left: 10px;
    z-index: 1;
}

[dir="rtl"] .form-horizontal .form-group .input-icon {
    left: auto;
    right: 0;
    margin-left: 0;
    margin-right: 10px;
}

.form-horizontal .form-control {
    color: #000;
    font-size: 15px;
    font-weight: 500;
    height: 50px;
    padding: 10px 10px 10px 40px;
    margin: 0 0 5px;
    border: none;
    border-bottom: 2px solid #e7e7e7;
    border-radius: 0px;
    box-shadow: none;
    width: 100%;
    transition: all 0.3s ease;
}

[dir="rtl"] .form-horizontal .form-control {
    padding: 10px 40px 10px 10px;
    text-align: right;
}

.form-horizontal .form-control:focus {
    box-shadow: none;
    border-bottom-color: #f563a2;
    outline: none;
}

.form-horizontal .form-control::placeholder {
    color: #999;
    font-size: 14px;
    font-weight: 500;
}

.checkbox-group {
    display: flex;
    align-items: center;
    gap: 8px;
    justify-content: flex-start;
}

.custom-control-label {
    color: #666;
    font-size: 14px;
    cursor: pointer;
}

.form-horizontal .signin {
    color: #fff;
    background-color: #f563a2;
    font-size: 16px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(245, 99, 162, 0.4);
    transition: all 0.4s ease;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.form-horizontal .signin:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(245, 99, 162, 0.5);
    letter-spacing: 4px;
}

.form-horizontal .signin:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.spinner {
    width: 18px;
    height: 18px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top-color: white;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.footer-text {
    color: rgba(255, 255, 255, 0.8);
    font-size: 13px;
    margin-top: 30px;
    text-align: center;
}

/* Responsive */
@media (max-width: 480px) {
    .form-container {
        padding: 20px 15px 40px;
    }
    
    .form-container .title {
        font-size: 18px;
    }
    
    .lang-switcher {
        flex-wrap: wrap;
        justify-content: center;
    }
}
</style>
