<script setup>
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t, isRtl, currentLocale } = useTranslations();

const props = defineProps({
    subscriptions: Object,
    plans: Array,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const status = ref(props.filters?.status || '');
const planId = ref(props.filters?.plan_id || '');

const applyFilters = () => {
    router.get(route('superadmin.subscriptions.index'), {
        search: search.value,
        status: status.value,
        plan_id: planId.value,
    }, {
        preserveState: true,
        replace: true,
    });
};

watch([search, status, planId], () => {
    applyFilters();
}, { debounce: 300 });

const cancelSubscription = (subscription) => {
    if (confirm(t('superadmin.confirm_cancel_subscription'))) {
        router.post(route('superadmin.subscriptions.cancel', subscription.id));
    }
};

const renewSubscription = (subscription) => {
    router.post(route('superadmin.subscriptions.renew', subscription.id));
};

const getStatusClass = (status) => {
    switch (status) {
        case 'active': return 'bg-green-100 text-green-800';
        case 'cancelled': return 'bg-red-100 text-red-800';
        case 'expired': return 'bg-gray-100 text-gray-800';
        case 'pending': return 'bg-yellow-100 text-yellow-800';
        default: return 'bg-gray-100 text-gray-800';
    }
};

const getStatusText = (status) => {
    switch (status) {
        case 'active': return t('superadmin.active');
        case 'cancelled': return t('superadmin.cancelled');
        case 'expired': return t('superadmin.expired');
        case 'pending': return t('superadmin.pending');
        default: return status;
    }
};

const formatDate = (date) => {
    const locale = currentLocale.value === 'ar' ? 'ar-MA' : currentLocale.value === 'fr' ? 'fr-MA' : 'en-US';
    return new Date(date).toLocaleDateString(locale);
};
</script>

<template>
    <Head :title="t('superadmin.manage_subscriptions')" />
    
    <SuperAdminLayout :title="t('superadmin.manage_subscriptions')">
        <!-- Header -->
        <div class="mb-6">
            <p class="text-gray-500">{{ t('superadmin.manage_subscriptions_desc') }}</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow-sm p-4">
                <p class="text-sm text-gray-500">{{ t('superadmin.total_subscriptions') }}</p>
                <p class="text-2xl font-bold text-gray-800">{{ subscriptions.total || 0 }}</p>
            </div>
            <div class="bg-green-50 rounded-xl shadow-sm p-4">
                <p class="text-sm text-green-600">{{ t('superadmin.active') }}</p>
                <p class="text-2xl font-bold text-green-800">{{ subscriptions.data?.filter(s => s.status === 'active').length || 0 }}</p>
            </div>
            <div class="bg-yellow-50 rounded-xl shadow-sm p-4">
                <p class="text-sm text-yellow-600">{{ t('superadmin.pending') }}</p>
                <p class="text-2xl font-bold text-yellow-800">{{ subscriptions.data?.filter(s => s.status === 'pending').length || 0 }}</p>
            </div>
            <div class="bg-red-50 rounded-xl shadow-sm p-4">
                <p class="text-sm text-red-600">{{ t('superadmin.cancelled') }}</p>
                <p class="text-2xl font-bold text-red-800">{{ subscriptions.data?.filter(s => s.status === 'cancelled').length || 0 }}</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.search') }}</label>
                    <input
                        v-model="search"
                        type="text"
                        :placeholder="t('superadmin.search_placeholder')"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                    />
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.status') }}</label>
                    <select
                        v-model="status"
                        class="block w-full py-2 px-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                    >
                        <option value="">{{ t('superadmin.all') }}</option>
                        <option value="active">{{ t('superadmin.active') }}</option>
                        <option value="pending">{{ t('superadmin.pending') }}</option>
                        <option value="cancelled">{{ t('superadmin.cancelled') }}</option>
                        <option value="expired">{{ t('superadmin.expired') }}</option>
                    </select>
                </div>

                <!-- Plan Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.plan') }}</label>
                    <select
                        v-model="planId"
                        class="block w-full py-2 px-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                    >
                        <option value="">{{ t('superadmin.all') }}</option>
                        <option v-for="plan in plans" :key="plan.id" :value="plan.id">{{ plan.name }}</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Subscriptions Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.clinic') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.plan') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.amount') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.start_date') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.end_date') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.status') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="subscription in subscriptions.data" :key="subscription.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <Link
                                    :href="route('superadmin.tenants.show', subscription.tenant_id)"
                                    class="text-[#089bab] hover:text-[#067985]"
                                >
                                    {{ subscription.tenant?.data?.name || subscription.tenant_id }}
                                </Link>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    :class="{
                                        'bg-gray-100 text-gray-800': subscription.plan?.name === 'Free',
                                        'bg-[#ceebee] text-[#089bab]': subscription.plan?.name === 'Basic',
                                        'bg-[#f563a2]/20 text-[#f563a2]': subscription.plan?.name === 'Pro',
                                        'bg-[#ffb177]/20 text-[#cc7a44]': subscription.plan?.name === 'Enterprise',
                                    }"
                                >
                                    {{ subscription.plan?.name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                {{ subscription.amount?.toLocaleString() || 0 }} {{ t('superadmin.currency') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ formatDate(subscription.starts_at) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ formatDate(subscription.ends_at) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    :class="getStatusClass(subscription.status)"
                                >
                                    {{ getStatusText(subscription.status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex items-center gap-2">
                                    <button
                                        v-if="subscription.status === 'active'"
                                        @click="cancelSubscription(subscription)"
                                        class="text-red-600 hover:text-red-900"
                                        :title="t('superadmin.cancel')"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                    <button
                                        v-if="['cancelled', 'expired'].includes(subscription.status)"
                                        @click="renewSubscription(subscription)"
                                        class="text-green-600 hover:text-green-900"
                                        :title="t('superadmin.renew')"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="!subscriptions.data?.length">
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                {{ t('superadmin.no_subscriptions') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div v-if="subscriptions.links?.length > 3" class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        {{ t('superadmin.showing_results', { from: subscriptions.from, to: subscriptions.to, total: subscriptions.total }) }}
                    </div>
                    <div class="flex gap-1">
                        <Link
                            v-for="link in subscriptions.links"
                            :key="link.label"
                            :href="link.url"
                            :class="[
                                'px-3 py-2 text-sm rounded-xl',
                                link.active ? 'bg-[#089bab] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200',
                                !link.url && 'opacity-50 cursor-not-allowed'
                            ]"
                            v-html="link.label"
                            :disabled="!link.url"
                        />
                    </div>
                </div>
            </div>
        </div>
    </SuperAdminLayout>
</template>
