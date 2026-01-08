<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t, isRtl } = useTranslations();

const props = defineProps({
    tenant: Object,
    plans: Array,
});

const form = useForm({
    name: props.tenant.name || '',
    email: props.tenant.email || '',
    phone: props.tenant.phone || '',
    domain: props.tenant.domains?.[0]?.domain || '',
    plan_id: props.tenant.plan_id || '',
    trial_ends_at: props.tenant.trial_ends_at?.split('T')[0] || '',
    address: props.tenant.address || '',
    city: props.tenant.city || '',
    is_active: props.tenant.is_active,
});

const submit = () => {
    form.put(route('superadmin.tenants.update', props.tenant.id));
};

const pageTitle = t('superadmin.edit_clinic', { name: props.tenant.name || props.tenant.id });
</script>

<template>
    <Head :title="pageTitle" />
    
    <SuperAdminLayout :title="pageTitle">
        <div class="max-w-4xl">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <ol class="flex items-center" :class="isRtl ? 'space-x-2 space-x-reverse' : 'space-x-2'">
                    <li>
                        <Link :href="route('superadmin.tenants.index')" class="text-[#089bab] hover:text-[#067985]">
                            {{ t('superadmin.manage_clinics') }}
                        </Link>
                    </li>
                    <li class="text-gray-400">/</li>
                    <li>
                        <Link :href="route('superadmin.tenants.show', tenant.id)" class="text-[#089bab] hover:text-[#067985]">
                            {{ tenant.name || tenant.id }}
                        </Link>
                    </li>
                    <li class="text-gray-400">/</li>
                    <li class="text-gray-600">{{ t('superadmin.edit') }}</li>
                </ol>
            </nav>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Clinic Information -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">{{ t('superadmin.clinic_info') }}</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.clinic_name') }} *</label>
                            <input
                                v-model="form.name"
                                type="text"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                                required
                            />
                            <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.email') }} *</label>
                            <input
                                v-model="form.email"
                                type="email"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                                required
                            />
                            <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.phone') }}</label>
                            <input
                                v-model="form.phone"
                                type="tel"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                            />
                            <p v-if="form.errors.phone" class="mt-1 text-sm text-red-600">{{ form.errors.phone }}</p>
                        </div>

                        <!-- Domain (Read Only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.subdomain') }}</label>
                            <div class="flex">
                                <input
                                    v-model="form.domain"
                                    type="text"
                                    class="block w-full px-4 py-2 border border-gray-300 bg-[#ceebee]/30"
                                    :class="isRtl ? 'rounded-r-xl' : 'rounded-l-xl'"
                                    disabled
                                />
                                <span 
                                    class="inline-flex items-center px-4 bg-[#ceebee] border border-[#089bab] text-[#089bab] text-sm font-medium"
                                    :class="isRtl ? 'border-r-0 rounded-l-xl' : 'border-l-0 rounded-r-xl'"
                                >
                                    .maristan.app
                                </span>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">{{ t('superadmin.cannot_change_domain') }}</p>
                        </div>

                        <!-- Address -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.address') }}</label>
                            <input
                                v-model="form.address"
                                type="text"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                            />
                        </div>

                        <!-- City -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.city') }}</label>
                            <input
                                v-model="form.city"
                                type="text"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                            />
                        </div>
                    </div>
                </div>

                <!-- Subscription -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">{{ t('superadmin.subscription') }}</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Plan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.plan') }} *</label>
                            <select
                                v-model="form.plan_id"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                                required
                            >
                                <option value="">{{ t('superadmin.choose_plan') }}</option>
                                <option v-for="plan in plans" :key="plan.id" :value="plan.id">
                                    {{ plan.name }} - {{ plan.price_monthly?.toLocaleString() || 0 }} {{ t('superadmin.currency') }}{{ t('superadmin.per_month') }}
                                </option>
                            </select>
                            <p v-if="form.errors.plan_id" class="mt-1 text-sm text-red-600">{{ form.errors.plan_id }}</p>
                        </div>

                        <!-- Trial End Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.trial_end_date') }}</label>
                            <input
                                v-model="form.trial_ends_at"
                                type="date"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                            />
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.status') }}</label>
                            <select
                                v-model="form.is_active"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                            >
                                <option :value="true">{{ t('superadmin.active') }}</option>
                                <option :value="false">{{ t('superadmin.suspended') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex items-center justify-end gap-4">
                    <Link
                        :href="route('superadmin.tenants.show', tenant.id)"
                        class="px-6 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors"
                    >
                        {{ t('superadmin.cancel') }}
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2 bg-gradient-to-r from-[#089bab] to-[#f563a2] text-white rounded-xl hover:from-[#067985] hover:to-[#d64d8a] transition-all duration-200 disabled:opacity-50 shadow-lg"
                    >
                        <span v-if="form.processing">{{ t('superadmin.saving') }}</span>
                        <span v-else>{{ t('superadmin.save_changes') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </SuperAdminLayout>
</template>
