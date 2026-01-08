<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useTranslations } from '@/Composables/useTranslations';

const { t, currentLocale, isRtl, direction } = useTranslations();

const props = defineProps({
    title: String,
});

const page = usePage();
const admin = computed(() => page.props.auth?.admin);
const supportedLocales = computed(() => page.props.supportedLocales || { ar: 'العربية', en: 'English', fr: 'Français' });

const sidebarOpen = ref(true);
const langDropdownOpen = ref(false);

const menuItems = computed(() => [
    { name: t('superadmin.dashboard'), route: 'superadmin.dashboard', icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' },
    { name: t('superadmin.tenants'), route: 'superadmin.tenants.index', icon: 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4' },
    { name: t('superadmin.plans'), route: 'superadmin.plans.index', icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01' },
    { name: t('superadmin.subscriptions'), route: 'superadmin.subscriptions.index', icon: 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z' },
]);

const changeLocale = (locale) => {
    // Use superadmin locale route when on central domain
    window.location.href = `/superadmin/locale/${locale}`;
};
</script>

<template>
    <div class="min-h-screen bg-gray-100" :dir="direction">
        <!-- Sidebar -->
        <aside
            :class="[sidebarOpen ? 'w-64' : 'w-20', isRtl ? 'right-0' : 'left-0']"
            class="fixed inset-y-0 bg-gradient-to-b from-[#089bab] to-[#067985] transition-all duration-300 z-50 shadow-xl"
        >
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 bg-[#067985]">
                <span v-if="sidebarOpen" class="text-white text-xl font-bold">{{ t('superadmin.app_name') || 'مريستان SaaS' }}</span>
                <span v-else class="text-white text-2xl font-bold">م</span>
            </div>

            <!-- Toggle Button -->
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="absolute top-20 bg-[#f563a2] text-white rounded-full p-1 hover:bg-[#d64d8a] shadow-lg"
                :class="isRtl ? '-left-3' : '-right-3'"
            >
                <svg class="w-5 h-5" :class="{ 'rotate-180': isRtl ? !sidebarOpen : sidebarOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Navigation -->
            <nav class="mt-8 px-4">
                <Link
                    v-for="item in menuItems"
                    :key="item.route"
                    :href="route(item.route)"
                    :class="[
                        route().current(item.route) || route().current(item.route + '.*')
                            ? 'bg-white text-[#089bab] shadow-md'
                            : 'text-white/90 hover:bg-white/20 hover:text-white',
                        'flex items-center px-4 py-3 rounded-xl mb-2 transition-all duration-200'
                    ]"
                >
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="item.icon" />
                    </svg>
                    <span v-if="sidebarOpen" :class="isRtl ? 'mr-3' : 'ml-3'">{{ item.name }}</span>
                </Link>
            </nav>

            <!-- User Info at Bottom -->
            <div class="absolute bottom-0 right-0 left-0 p-4 border-t border-white/20">
                <div class="flex items-center" :class="{ 'justify-center': !sidebarOpen }">
                    <div class="w-10 h-10 bg-[#f563a2] rounded-full flex items-center justify-center text-white font-bold shadow-md">
                        {{ admin?.name?.charAt(0) || 'A' }}
                    </div>
                    <div v-if="sidebarOpen" :class="isRtl ? 'mr-3' : 'ml-3'">
                        <p class="text-white font-medium">{{ admin?.name }}</p>
                        <p class="text-white/70 text-sm">{{ t('superadmin.system_admin') || 'مدير النظام' }}</p>
                    </div>
                </div>
                <Link
                    :href="route('superadmin.logout')"
                    method="post"
                    as="button"
                    class="w-full mt-4 flex items-center justify-center px-4 py-2 bg-[#f563a2] text-white rounded-xl hover:bg-[#d64d8a] transition-colors shadow-md"
                    :class="{ 'px-2': !sidebarOpen }"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span v-if="sidebarOpen" :class="isRtl ? 'mr-2' : 'ml-2'">{{ t('superadmin.logout') }}</span>
                </Link>
            </div>
        </aside>

        <!-- Main Content -->
        <main
            :class="[sidebarOpen ? (isRtl ? 'mr-64' : 'ml-64') : (isRtl ? 'mr-20' : 'ml-20')]"
            class="transition-all duration-300"
        >
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="px-6 py-4 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">{{ title }}</h1>
                    
                    <!-- Language Switcher -->
                    <div class="relative">
                        <button
                            @click="langDropdownOpen = !langDropdownOpen"
                            class="flex items-center gap-2 px-3 py-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-colors"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ supportedLocales[currentLocale] }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <div
                            v-show="langDropdownOpen"
                            @click.away="langDropdownOpen = false"
                            class="absolute top-full mt-2 bg-white rounded-lg shadow-lg border py-1 min-w-[120px] z-50"
                            :class="isRtl ? 'left-0' : 'right-0'"
                        >
                            <button
                                v-for="(name, code) in supportedLocales"
                                :key="code"
                                @click="changeLocale(code); langDropdownOpen = false"
                                class="w-full px-4 py-2 text-sm hover:bg-gray-100 transition-colors"
                                :class="[
                                    code === currentLocale ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700',
                                    isRtl ? 'text-right' : 'text-left'
                                ]"
                            >
                                {{ name }}
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-6">
                <slot />
            </div>
        </main>
    </div>
</template>
