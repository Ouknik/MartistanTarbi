<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t, isRtl } = useTranslations();

const props = defineProps({
    plan: {
        type: Object,
        default: null,
    },
});

const isEdit = !!props.plan;

const form = useForm({
    name: props.plan?.name || '',
    slug: props.plan?.slug || '',
    description: props.plan?.description || '',
    price_monthly: props.plan?.price_monthly || 0,
    price_yearly: props.plan?.price_yearly || 0,
    trial_days: props.plan?.trial_days || 14,
    max_doctors: props.plan?.max_doctors || null,
    max_patients: props.plan?.max_patients || null,
    max_storage: props.plan?.max_storage || null,
    features: props.plan?.features || [],
    is_active: props.plan?.is_active ?? true,
});

const newFeature = ref('');

const addFeature = () => {
    if (newFeature.value.trim()) {
        form.features.push(newFeature.value.trim());
        newFeature.value = '';
    }
};

const removeFeature = (index) => {
    form.features.splice(index, 1);
};

const generateSlug = () => {
    form.slug = form.name
        .toLowerCase()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-');
};

const submit = () => {
    if (isEdit) {
        form.put(route('superadmin.plans.update', props.plan.id));
    } else {
        form.post(route('superadmin.plans.store'));
    }
};

const pageTitle = isEdit ? t('superadmin.edit_plan', { name: props.plan?.name }) : t('superadmin.add_plan');
</script>

<template>
    <Head :title="pageTitle" />
    
    <SuperAdminLayout :title="pageTitle">
        <div class="max-w-4xl">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <ol class="flex items-center" :class="isRtl ? 'space-x-2 space-x-reverse' : 'space-x-2'">
                    <li>
                        <Link :href="route('superadmin.plans.index')" class="text-[#089bab] hover:text-[#067985]">
                            {{ t('superadmin.manage_plans') }}
                        </Link>
                    </li>
                    <li class="text-gray-400">/</li>
                    <li class="text-gray-600">{{ isEdit ? t('superadmin.edit') : t('superadmin.add_plan') }}</li>
                </ol>
            </nav>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Basic Info -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">{{ t('superadmin.basic_info') }}</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.plan_name') }} *</label>
                            <input
                                v-model="form.name"
                                @blur="!isEdit && generateSlug()"
                                type="text"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                                required
                            />
                            <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                        </div>

                        <!-- Slug -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.slug') }} *</label>
                            <input
                                v-model="form.slug"
                                type="text"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                                required
                                :disabled="isEdit"
                                :class="{ 'bg-[#ceebee]/30': isEdit }"
                            />
                            <p v-if="form.errors.slug" class="mt-1 text-sm text-red-600">{{ form.errors.slug }}</p>
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.description') }}</label>
                            <textarea
                                v-model="form.description"
                                rows="3"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                            ></textarea>
                        </div>
                    </div>
                </div>

                <!-- Pricing -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">{{ t('superadmin.pricing') }}</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Monthly Price -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.monthly_price') }} ({{ t('superadmin.currency') }})</label>
                            <input
                                v-model.number="form.price_monthly"
                                type="number"
                                min="0"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                            />
                        </div>

                        <!-- Yearly Price -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.yearly_price') }} ({{ t('superadmin.currency') }})</label>
                            <input
                                v-model.number="form.price_yearly"
                                type="number"
                                min="0"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                            />
                        </div>

                        <!-- Trial Days -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.trial_days') }}</label>
                            <input
                                v-model.number="form.trial_days"
                                type="number"
                                min="0"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                            />
                        </div>
                    </div>
                </div>

                <!-- Limits -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">{{ t('superadmin.limits') }}</h3>
                    <p class="text-sm text-gray-500 mb-4">{{ t('superadmin.unlimited_hint') }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Max Doctors -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.max_doctors') }}</label>
                            <input
                                v-model.number="form.max_doctors"
                                type="number"
                                min="0"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                                :placeholder="t('superadmin.unlimited')"
                            />
                        </div>

                        <!-- Max Patients -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.max_patients') }}</label>
                            <input
                                v-model.number="form.max_patients"
                                type="number"
                                min="0"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                                :placeholder="t('superadmin.unlimited')"
                            />
                        </div>

                        <!-- Max Storage -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ t('superadmin.max_storage') }} (GB)</label>
                            <input
                                v-model.number="form.max_storage"
                                type="number"
                                min="0"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                                :placeholder="t('superadmin.unlimited')"
                            />
                        </div>
                    </div>
                </div>

                <!-- Features -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">{{ t('superadmin.features') }}</h3>
                    
                    <!-- Add Feature -->
                    <div class="flex gap-2 mb-4">
                        <input
                            v-model="newFeature"
                            type="text"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#089bab] focus:border-[#089bab]"
                            :placeholder="t('superadmin.feature_placeholder')"
                            @keyup.enter="addFeature"
                        />
                        <button
                            type="button"
                            @click="addFeature"
                            class="px-4 py-2 bg-[#089bab] text-white rounded-xl hover:bg-[#067985] transition-colors"
                        >
                            {{ t('superadmin.add_feature') }}
                        </button>
                    </div>

                    <!-- Features List -->
                    <div class="space-y-2">
                        <div
                            v-for="(feature, index) in form.features"
                            :key="index"
                            class="flex items-center justify-between px-4 py-2 bg-gray-50 rounded-lg"
                        >
                            <span>{{ feature }}</span>
                            <button
                                type="button"
                                @click="removeFeature(index)"
                                class="text-red-500 hover:text-red-700"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p v-if="!form.features.length" class="text-gray-500 text-center py-4">
                            {{ t('superadmin.no_features') }}
                        </p>
                    </div>
                </div>

                <!-- Status -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <input
                            v-model="form.is_active"
                            type="checkbox"
                            id="is_active"
                            class="h-4 w-4 text-[#089bab] focus:ring-[#089bab] border-gray-300 rounded"
                        />
                        <label for="is_active" class="block text-sm font-medium text-gray-700" :class="isRtl ? 'mr-3' : 'ml-3'">
                            {{ t('superadmin.plan_active') }}
                        </label>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex items-center justify-end gap-4">
                    <Link
                        :href="route('superadmin.plans.index')"
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
                        <span v-else>{{ isEdit ? t('superadmin.save_changes') : t('superadmin.create_plan') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </SuperAdminLayout>
</template>
