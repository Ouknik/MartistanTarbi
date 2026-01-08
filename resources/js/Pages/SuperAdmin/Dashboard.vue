<script setup>
import { Head } from '@inertiajs/vue3';
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t, isRtl } = useTranslations();

defineProps({
    stats: Object,
    recentTenants: Array,
    subscriptionsByPlan: Array,
    monthlyRevenue: Array,
});
</script>

<template>
    <Head :title="t('superadmin.dashboard')" />
    
    <SuperAdminLayout :title="t('superadmin.dashboard')">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Tenants -->
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow" :class="isRtl ? 'border-r-4' : 'border-l-4'" style="border-color: #089bab;">
                <div class="flex items-center">
                    <div class="p-3 bg-[#ceebee] rounded-full">
                        <svg class="w-8 h-8 text-[#089bab]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div :class="isRtl ? 'mr-4' : 'ml-4'">
                        <p class="text-sm text-gray-500">{{ t('superadmin.total_clinics') }}</p>
                        <p class="text-2xl font-bold text-gray-800">{{ stats?.total_tenants || 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Tenants -->
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow" :class="isRtl ? 'border-r-4' : 'border-l-4'" style="border-color: #27b345;">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-8 h-8 text-[#27b345]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div :class="isRtl ? 'mr-4' : 'ml-4'">
                        <p class="text-sm text-gray-500">{{ t('superadmin.active_clinics') }}</p>
                        <p class="text-2xl font-bold text-gray-800">{{ stats?.active_tenants || 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Subscriptions -->
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow" :class="isRtl ? 'border-r-4' : 'border-l-4'" style="border-color: #f563a2;">
                <div class="flex items-center">
                    <div class="p-3 bg-[#fae9dd] rounded-full">
                        <svg class="w-8 h-8 text-[#f563a2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <div :class="isRtl ? 'mr-4' : 'ml-4'">
                        <p class="text-sm text-gray-500">{{ t('superadmin.active_subscriptions') }}</p>
                        <p class="text-2xl font-bold text-gray-800">{{ stats?.active_subscriptions || 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue -->
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow" :class="isRtl ? 'border-r-4' : 'border-l-4'" style="border-color: #ffb177;">
                <div class="flex items-center">
                    <div class="p-3 bg-[#fae9dd] rounded-full">
                        <svg class="w-8 h-8 text-[#ffb177]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div :class="isRtl ? 'mr-4' : 'ml-4'">
                        <p class="text-sm text-gray-500">{{ t('superadmin.monthly_revenue') }}</p>
                        <p class="text-2xl font-bold text-gray-800">{{ stats?.monthly_revenue?.toLocaleString() || 0 }} {{ t('superadmin.currency') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts & Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Subscriptions by Plan -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">{{ t('superadmin.subscriptions_by_plan') }}</h3>
                <div class="space-y-4">
                    <div v-for="plan in subscriptionsByPlan" :key="plan.name" class="flex items-center">
                        <div class="flex-1">
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">{{ plan.name }}</span>
                                <span class="text-sm text-gray-500">{{ plan.count }} {{ t('superadmin.clinic') }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div
                                    class="h-2 rounded-full"
                                    :class="{
                                        'bg-gray-400': plan.name === 'Free',
                                        'bg-[#089bab]': plan.name === 'Basic',
                                        'bg-[#f563a2]': plan.name === 'Pro',
                                        'bg-[#ffb177]': plan.name === 'Enterprise',
                                    }"
                                    :style="{ width: `${(plan.count / (stats?.total_tenants || 1)) * 100}%` }"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue Chart -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">{{ t('superadmin.monthly_revenue_chart') }}</h3>
                <div class="flex items-end justify-between h-48">
                    <div
                        v-for="(month, index) in monthlyRevenue"
                        :key="index"
                        class="flex flex-col items-center"
                    >
                        <div
                            class="w-8 bg-gradient-to-t from-[#089bab] to-[#f563a2] rounded-t hover:from-[#067985] hover:to-[#d64d8a] transition-colors"
                            :style="{ height: `${(month.revenue / (Math.max(...monthlyRevenue.map(m => m.revenue)) || 1)) * 150}px` }"
                        ></div>
                        <span class="text-xs text-gray-500 mt-2">{{ month.month }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Tenants -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-800">{{ t('superadmin.recent_clinics') }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.clinic') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.plan') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.status') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.registration_date') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="tenant in recentTenants" :key="tenant.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-[#ceebee] rounded-full flex items-center justify-center">
                                        <span class="text-[#089bab] font-bold">{{ tenant.data?.name?.charAt(0) || 'C' }}</span>
                                    </div>
                                    <div :class="isRtl ? 'mr-4' : 'ml-4'">
                                        <div class="text-sm font-medium text-gray-900">{{ tenant.data?.name || tenant.id }}</div>
                                        <div class="text-sm text-gray-500">{{ tenant.domains?.[0]?.domain || '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    :class="{
                                        'bg-gray-100 text-gray-800': tenant.plan?.name === 'Free',
                                        'bg-[#ceebee] text-[#089bab]': tenant.plan?.name === 'Basic',
                                        'bg-[#fae9dd] text-[#f563a2]': tenant.plan?.name === 'Pro',
                                        'bg-[#fff3e6] text-[#ffb177]': tenant.plan?.name === 'Enterprise',
                                    }"
                                >
                                    {{ tenant.plan?.name || 'Free' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    :class="tenant.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                >
                                    {{ tenant.is_active ? t('superadmin.active') : t('superadmin.inactive') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ new Date(tenant.created_at).toLocaleDateString(isRtl ? 'ar-MA' : 'en-US') }}
                            </td>
                        </tr>
                        <tr v-if="!recentTenants?.length">
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                {{ t('superadmin.no_clinics_registered') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </SuperAdminLayout>
</template>
