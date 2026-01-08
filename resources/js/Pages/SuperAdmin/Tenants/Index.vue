<script setup>
import { ref, watch, computed } from 'vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t, isRtl } = useTranslations();

const props = defineProps({
    tenants: Object,
    plans: Array,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const status = ref(props.filters?.status || '');
const planId = ref(props.filters?.plan_id || '');

const applyFilters = () => {
    router.get(route('superadmin.tenants.index'), {
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

const deleteTenant = (tenant) => {
    if (confirm(t('superadmin.confirm_delete_clinic', { name: tenant.name || tenant.id }))) {
        router.delete(route('superadmin.tenants.destroy', tenant.id));
    }
};

const toggleStatus = (tenant) => {
    router.post(route('superadmin.tenants.toggle-status', tenant.id));
};
</script>

<template>
    <Head :title="t('superadmin.manage_clinics')" />
    
    <SuperAdminLayout :title="t('superadmin.manage_clinics')">
        <!-- Header with Add Button -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <p class="text-gray-500">{{ t('superadmin.manage_clinics_desc') }}</p>
            </div>
            <Link
                :href="route('superadmin.tenants.create')"
                class="inline-flex items-center px-4 py-2 bg-[#089bab] text-white rounded-xl hover:bg-[#067985] transition-colors shadow-md"
            >
                <svg class="w-5 h-5" :class="isRtl ? 'ml-2' : 'mr-2'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ t('superadmin.add_clinic') }}
            </Link>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.search') }}</label>
                    <div class="relative">
                        <input
                            v-model="search"
                            type="text"
                            :placeholder="t('superadmin.search_placeholder')"
                            class="block w-full py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                            :class="isRtl ? 'pr-10 pl-4' : 'pl-10 pr-4'"
                        />
                        <div class="absolute inset-y-0 flex items-center pointer-events-none" :class="isRtl ? 'right-0 pr-3' : 'left-0 pl-3'">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
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
                        <option value="inactive">{{ t('superadmin.suspended') }}</option>
                        <option value="trial">{{ t('superadmin.trial') }}</option>
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

        <!-- Tenants Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.clinic') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.domain') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.plan') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.status') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.registration_date') }}</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="isRtl ? 'text-right' : 'text-left'">{{ t('superadmin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="tenant in tenants.data" :key="tenant.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-[#ceebee] rounded-full flex items-center justify-center">
                                        <span class="text-[#089bab] font-bold">{{ tenant.name?.charAt(0) || 'C' }}</span>
                                    </div>
                                    <div :class="isRtl ? 'mr-4' : 'ml-4'">
                                        <div class="text-sm font-medium text-gray-900">{{ tenant.name || tenant.id }}</div>
                                        <div class="text-sm text-gray-500">{{ tenant.email || '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">{{ tenant.domains?.[0]?.domain || '-' }}</span>
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
                                <button
                                    @click="toggleStatus(tenant)"
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full cursor-pointer transition-colors"
                                    :class="tenant.is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200'"
                                >
                                    {{ tenant.is_active ? t('superadmin.active') : t('superadmin.suspended') }}
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ new Date(tenant.created_at).toLocaleDateString(isRtl ? 'ar-MA' : 'en-US') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex items-center gap-2">
                                    <Link
                                        :href="route('superadmin.tenants.show', tenant.id)"
                                        class="text-[#089bab] hover:text-[#067985]"
                                        :title="t('superadmin.view')"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </Link>
                                    <Link
                                        :href="route('superadmin.tenants.edit', tenant.id)"
                                        class="text-[#ffb177] hover:text-[#e6a064]"
                                        :title="t('superadmin.edit')"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </Link>
                                    <button
                                        @click="deleteTenant(tenant)"
                                        class="text-red-600 hover:text-red-900"
                                        :title="t('superadmin.delete')"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="!tenants.data?.length">
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                {{ t('superadmin.no_tenants') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div v-if="tenants.links?.length > 3" class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        {{ t('superadmin.showing_results', { from: tenants.from, to: tenants.to, total: tenants.total }) }}
                    </div>
                    <div class="flex gap-1">
                        <Link
                            v-for="link in tenants.links"
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
