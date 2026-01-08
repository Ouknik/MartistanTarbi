<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t, isRtl, currentLocale } = useTranslations();

const props = defineProps({
    tenant: Object,
    subscriptions: Array,
});

const toggleStatus = () => {
    router.post(route('superadmin.tenants.toggle-status', props.tenant.id));
};

const extendTrial = () => {
    const days = prompt(t('superadmin.extend_trial_days'), '7');
    if (days) {
        router.post(route('superadmin.tenants.extend-trial', props.tenant.id), { days: parseInt(days) });
    }
};

const deleteTenant = () => {
    if (confirm(t('superadmin.confirm_delete_clinic', { name: props.tenant.name || props.tenant.id }))) {
        router.delete(route('superadmin.tenants.destroy', props.tenant.id));
    }
};

const formatDate = (date) => {
    const locale = currentLocale.value === 'ar' ? 'ar-MA' : currentLocale.value === 'fr' ? 'fr-MA' : 'en-US';
    return new Date(date).toLocaleDateString(locale);
};

const getStatusText = (status) => {
    switch (status) {
        case 'active': return t('superadmin.active');
        case 'cancelled': return t('superadmin.cancelled');
        case 'expired': return t('superadmin.expired');
        default: return status;
    }
};
</script>

<template>
    <Head :title="t('superadmin.clinic') + ': ' + (tenant.name || tenant.id)" />
    
    <SuperAdminLayout :title="tenant.name || tenant.id">
        <!-- Breadcrumb -->
        <nav class="mb-6">
            <ol class="flex items-center" :class="isRtl ? 'space-x-2 space-x-reverse' : 'space-x-2'">
                <li>
                    <Link :href="route('superadmin.tenants.index')" class="text-[#089bab] hover:text-[#067985]">
                        {{ t('superadmin.manage_clinics') }}
                    </Link>
                </li>
                <li class="text-gray-400">/</li>
                <li class="text-gray-600">{{ tenant.name || tenant.id }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Clinic Details -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-800">{{ t('superadmin.clinic_info') }}</h3>
                        <Link
                            :href="route('superadmin.tenants.edit', tenant.id)"
                            class="text-[#089bab] hover:text-[#067985] text-sm"
                        >
                            {{ t('superadmin.edit') }}
                        </Link>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">{{ t('superadmin.clinic_name') }}</p>
                            <p class="font-medium text-gray-900">{{ tenant.name || '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">{{ t('superadmin.email') }}</p>
                            <p class="font-medium text-gray-900">{{ tenant.email || '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">{{ t('superadmin.phone') }}</p>
                            <p class="font-medium text-gray-900">{{ tenant.phone || '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">{{ t('superadmin.domain') }}</p>
                            <p class="font-medium text-gray-900">{{ tenant.domains?.[0]?.domain || '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">{{ t('superadmin.address') }}</p>
                            <p class="font-medium text-gray-900">{{ tenant.address || '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">{{ t('superadmin.city') }}</p>
                            <p class="font-medium text-gray-900">{{ tenant.city || '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">{{ t('superadmin.registration_date') }}</p>
                            <p class="font-medium text-gray-900">{{ formatDate(tenant.created_at) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">{{ t('superadmin.database') }}</p>
                            <p class="font-medium text-gray-900 font-mono text-sm">{{ tenant.tenancy_db_name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Subscriptions History -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">{{ t('superadmin.subscription_history') }}</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-xs font-medium text-gray-500" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.plan') }}</th>
                                    <th class="px-4 py-2 text-xs font-medium text-gray-500" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.from') }}</th>
                                    <th class="px-4 py-2 text-xs font-medium text-gray-500" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.to') }}</th>
                                    <th class="px-4 py-2 text-xs font-medium text-gray-500" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.amount') }}</th>
                                    <th class="px-4 py-2 text-xs font-medium text-gray-500" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.status') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="sub in subscriptions" :key="sub.id">
                                    <td class="px-4 py-3 text-sm">{{ sub.plan?.name }}</td>
                                    <td class="px-4 py-3 text-sm">{{ formatDate(sub.starts_at) }}</td>
                                    <td class="px-4 py-3 text-sm">{{ formatDate(sub.ends_at) }}</td>
                                    <td class="px-4 py-3 text-sm">{{ sub.amount?.toLocaleString() }} {{ t('superadmin.currency') }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full"
                                            :class="{
                                                'bg-green-100 text-green-800': sub.status === 'active',
                                                'bg-red-100 text-red-800': sub.status === 'cancelled',
                                                'bg-gray-100 text-gray-800': sub.status === 'expired',
                                            }"
                                        >
                                            {{ getStatusText(sub.status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr v-if="!subscriptions?.length">
                                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                        {{ t('superadmin.no_subscriptions') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">{{ t('superadmin.status') }}</h3>
                    
                    <div class="text-center mb-4">
                        <span
                            class="px-4 py-2 text-lg font-semibold rounded-full"
                            :class="tenant.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                        >
                            {{ tenant.is_active ? t('superadmin.active') : t('superadmin.suspended') }}
                        </span>
                    </div>

                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">{{ t('superadmin.current_plan') }}:</span>
                            <span class="font-medium">{{ tenant.plan?.name || 'Free' }}</span>
                        </div>
                        <div v-if="tenant.trial_ends_at" class="flex justify-between">
                            <span class="text-gray-500">{{ t('superadmin.trial_end_date') }}:</span>
                            <span class="font-medium">{{ formatDate(tenant.trial_ends_at) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">{{ t('superadmin.quick_actions') }}</h3>
                    
                    <div class="space-y-3">
                        <button
                            @click="toggleStatus"
                            class="w-full flex items-center justify-center px-4 py-2 rounded-lg transition-colors"
                            :class="tenant.is_active ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200'"
                        >
                            <svg class="w-5 h-5" :class="isRtl ? 'ml-2' : 'mr-2'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path v-if="tenant.is_active" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ tenant.is_active ? t('superadmin.suspend_clinic') : t('superadmin.activate_clinic') }}
                        </button>

                        <button
                            @click="extendTrial"
                            class="w-full flex items-center justify-center px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition-colors"
                        >
                            <svg class="w-5 h-5" :class="isRtl ? 'ml-2' : 'mr-2'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ t('superadmin.extend_trial') }}
                        </button>

                        <Link
                            :href="route('superadmin.tenants.edit', tenant.id)"
                            class="w-full flex items-center justify-center px-4 py-2 bg-[#ceebee] text-[#089bab] rounded-lg hover:bg-[#089bab] hover:text-white transition-colors"
                        >
                            <svg class="w-5 h-5" :class="isRtl ? 'ml-2' : 'mr-2'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            {{ t('superadmin.edit_data') }}
                        </Link>

                        <button
                            @click="deleteTenant"
                            class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors"
                        >
                            <svg class="w-5 h-5" :class="isRtl ? 'ml-2' : 'mr-2'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            {{ t('superadmin.delete_clinic') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </SuperAdminLayout>
</template>
