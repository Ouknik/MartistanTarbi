<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t, isRtl } = useTranslations();

const props = defineProps({
    plans: Array,
});

const deletePlan = (plan) => {
    if (confirm(t('superadmin.confirm_delete_plan', { name: plan.name }))) {
        router.delete(route('superadmin.plans.destroy', plan.id));
    }
};

const toggleStatus = (plan) => {
    router.post(route('superadmin.plans.toggle-status', plan.id));
};
</script>

<template>
    <Head :title="t('superadmin.manage_plans')" />
    
    <SuperAdminLayout :title="t('superadmin.manage_plans')">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <p class="text-gray-500">{{ t('superadmin.manage_plans_desc') }}</p>
            </div>
            <Link
                :href="route('superadmin.plans.create')"
                class="inline-flex items-center px-4 py-2 bg-[#089bab] text-white rounded-xl hover:bg-[#067985] transition-colors shadow-lg"
            >
                <svg class="w-5 h-5" :class="isRtl ? 'ml-2' : 'mr-2'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ t('superadmin.add_plan') }}
            </Link>
        </div>

        <!-- Plans Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
                v-for="plan in plans"
                :key="plan.id"
                class="bg-white rounded-xl shadow-sm overflow-hidden"
                :class="{ 'opacity-60': !plan.is_active }"
            >
                <!-- Plan Header -->
                <div
                    class="p-6 text-center"
                    :class="{
                        'bg-gray-100': plan.name === 'Free',
                        'bg-[#089bab] text-white': plan.name === 'Basic',
                        'bg-[#f563a2] text-white': plan.name === 'Pro',
                        'bg-gradient-to-r from-[#089bab] to-[#f563a2] text-white': plan.name === 'Enterprise',
                    }"
                >
                    <h3 class="text-xl font-bold">{{ plan.name }}</h3>
                    <p class="text-3xl font-bold mt-2">
                        {{ plan.price_monthly?.toLocaleString() || 0 }}
                        <span class="text-sm font-normal">{{ t('superadmin.currency') }}{{ t('superadmin.per_month') }}</span>
                    </p>
                    <p class="text-sm mt-1 opacity-80">
                        {{ plan.price_yearly?.toLocaleString() || 0 }} {{ t('superadmin.currency') }}{{ t('superadmin.per_year') }}
                    </p>
                </div>

                <!-- Plan Features -->
                <div class="p-6">
                    <ul class="space-y-3">
                        <li class="flex items-center text-sm">
                            <svg class="w-5 h-5 text-[#27b345]" :class="isRtl ? 'ml-2' : 'mr-2'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ plan.max_doctors || '∞' }} {{ t('superadmin.doctors') }}
                        </li>
                        <li class="flex items-center text-sm">
                            <svg class="w-5 h-5 text-[#27b345]" :class="isRtl ? 'ml-2' : 'mr-2'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ plan.max_patients || '∞' }} {{ t('superadmin.patients') }}
                        </li>
                        <li class="flex items-center text-sm">
                            <svg class="w-5 h-5 text-[#27b345]" :class="isRtl ? 'ml-2' : 'mr-2'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ plan.max_storage || '∞' }} {{ t('superadmin.gb_storage') }}
                        </li>
                        <li v-for="feature in (plan.features || [])" :key="feature" class="flex items-center text-sm">
                            <svg class="w-5 h-5 text-[#27b345]" :class="isRtl ? 'ml-2' : 'mr-2'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ feature }}
                        </li>
                    </ul>

                    <!-- Status -->
                    <div class="mt-4 pt-4 border-t">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">{{ t('superadmin.status') }}:</span>
                            <button
                                @click="toggleStatus(plan)"
                                class="px-2 py-1 text-xs rounded-full"
                                :class="plan.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                            >
                                {{ plan.is_active ? t('superadmin.active') : t('superadmin.disabled') }}
                            </button>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-sm text-gray-500">{{ t('superadmin.subscribers_count') }}:</span>
                            <span class="text-sm font-medium">{{ plan.tenants_count || 0 }}</span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-6 pb-6 flex gap-2">
                    <Link
                        :href="route('superadmin.plans.edit', plan.id)"
                        class="flex-1 text-center px-4 py-2 bg-[#ceebee] text-[#089bab] rounded-lg hover:bg-[#089bab] hover:text-white transition-colors text-sm"
                    >
                        {{ t('superadmin.edit') }}
                    </Link>
                    <button
                        @click="deletePlan(plan)"
                        class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-sm"
                        :disabled="plan.tenants_count > 0"
                        :class="{ 'opacity-50 cursor-not-allowed': plan.tenants_count > 0 }"
                    >
                        {{ t('superadmin.delete') }}
                    </button>
                </div>
            </div>
        </div>
    </SuperAdminLayout>
</template>
