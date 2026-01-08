<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t, isRtl } = useTranslations();

const props = defineProps({
    plans: Array,
});

const form = useForm({
    name: '',
    email: '',
    phone: '',
    subdomain: '',
    plan_id: '',
    trial_days: 14,
    address: '',
    city: '',
    admin_name: '',
    admin_email: '',
    admin_password: '',
});

const submit = () => {
    form.post(route('superadmin.tenants.store'));
};
</script>

<template>
    <Head :title="t('superadmin.add_clinic')" />
    
    <SuperAdminLayout :title="t('superadmin.add_clinic')">
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
                    <li class="text-gray-600">{{ t('superadmin.add_clinic') }}</li>
                </ol>
            </nav>

            <!-- Error Alert -->
            <div v-if="form.errors.error" class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-400" :class="isRtl ? 'ml-3' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-red-700">{{ form.errors.error }}</span>
                </div>
            </div>

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
                                placeholder="clinic@example.com"
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
                                placeholder="0550000000"
                            />
                            <p v-if="form.errors.phone" class="mt-1 text-sm text-red-600">{{ form.errors.phone }}</p>
                        </div>

                        <!-- Domain -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.subdomain') }} *</label>
                            <div class="flex">
                                <input
                                    v-model="form.subdomain"
                                    type="text"
                                    class="block w-full px-4 py-2 border border-gray-300 focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                                    :class="isRtl ? 'rounded-r-xl' : 'rounded-l-xl'"
                                    placeholder="alshifa"
                                    required
                                />
                                <span 
                                    class="inline-flex items-center px-4 bg-[#ceebee] border border-[#089bab] text-[#089bab] text-sm font-medium"
                                    :class="isRtl ? 'border-r-0 rounded-l-xl' : 'border-l-0 rounded-r-xl'"
                                >
                                    .maristan.app
                                </span>
                            </div>
                            <p v-if="form.errors.subdomain" class="mt-1 text-sm text-red-600">{{ form.errors.subdomain }}</p>
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
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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

                        <!-- Trial Days -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.trial_days') }}</label>
                            <input
                                v-model="form.trial_days"
                                type="number"
                                min="0"
                                max="90"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                            />
                            <p class="mt-1 text-xs text-gray-500">{{ t('superadmin.default_trial_period') }}</p>
                            <p v-if="form.errors.trial_days" class="mt-1 text-sm text-red-600">{{ form.errors.trial_days }}</p>
                        </div>
                    </div>
                </div>

                <!-- Admin Account -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">{{ t('superadmin.admin_account') }}</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Admin Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.admin_name') }} *</label>
                            <input
                                v-model="form.admin_name"
                                type="text"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                                required
                            />
                            <p v-if="form.errors.admin_name" class="mt-1 text-sm text-red-600">{{ form.errors.admin_name }}</p>
                        </div>

                        <!-- Admin Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.admin_email') }} *</label>
                            <input
                                v-model="form.admin_email"
                                type="email"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                                placeholder="admin@clinic.com"
                                required
                            />
                            <p v-if="form.errors.admin_email" class="mt-1 text-sm text-red-600">{{ form.errors.admin_email }}</p>
                        </div>

                        <!-- Admin Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.admin_password') }} *</label>
                            <input
                                v-model="form.admin_password"
                                type="password"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                                placeholder="••••••••"
                                required
                            />
                            <p v-if="form.errors.admin_password" class="mt-1 text-sm text-red-600">{{ form.errors.admin_password }}</p>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex items-center justify-end gap-4">
                    <Link
                        :href="route('superadmin.tenants.index')"
                        class="px-6 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors"
                    >
                        {{ t('superadmin.cancel') }}
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-6 py-2 bg-gradient-to-r from-[#089bab] to-[#f563a2] text-white rounded-xl hover:from-[#067985] hover:to-[#d64d8a] transition-all duration-200 disabled:opacity-50 shadow-lg"
                    >
                        <span v-if="form.processing">{{ t('superadmin.creating') }}</span>
                        <span v-else>{{ t('superadmin.create_clinic') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </SuperAdminLayout>
</template>
