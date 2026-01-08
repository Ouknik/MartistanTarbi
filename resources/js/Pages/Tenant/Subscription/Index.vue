<template>
    <AppLayout :title="$t('tenant.my_subscription')">
        <div class="py-6 sm:py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-6 sm:mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $t('tenant.my_subscription') }}
                    </h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        {{ $t('tenant.subscription_details') }}
                    </p>
                </div>

                <!-- Alerts -->
                <div v-if="showWarning" class="mb-6">
                    <div v-if="isInTrial && trialDaysRemaining <= 7" 
                         class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    {{ $t('tenant.alert_trial_ending', { days: trialDaysRemaining }) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div v-else-if="daysRemaining <= 7 && daysRemaining > 0"
                         class="bg-orange-50 border-l-4 border-orange-400 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-orange-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-orange-700">
                                    {{ $t('tenant.alert_subscription_ending', { days: daysRemaining }) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div v-else-if="daysRemaining <= 0"
                         class="bg-red-50 border-l-4 border-red-400 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    {{ $t('tenant.alert_subscription_expired') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column: Current Subscription -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Current Plan Card -->
                        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                                <h2 class="text-xl font-semibold text-white">
                                    {{ $t('tenant.current_plan') }}
                                </h2>
                            </div>

                            <div v-if="currentSubscription" class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {{ currentSubscription.plan?.name }}
                                        </h3>
                                        <p class="text-gray-600 dark:text-gray-400">
                                            {{ currentSubscription.amount?.toLocaleString() }} MAD
                                            {{ $t('tenant.per_month') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span :class="statusClass" class="px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ statusText }}
                                        </span>
                                    </div>
                                </div>

                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4 space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600 dark:text-gray-400">{{ $t('tenant.subscription_expires') }}</span>
                                        <span class="font-medium text-gray-900 dark:text-gray-100">
                                            {{ formatDate(currentSubscription.ends_at) }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600 dark:text-gray-400">{{ $t('tenant.days_remaining') }}</span>
                                        <span class="font-medium" :class="daysRemaining <= 7 ? 'text-red-600' : 'text-gray-900 dark:text-gray-100'">
                                            {{ daysRemaining }} {{ $t('tenant.days_remaining') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                                    <Link :href="route('subscription.plans')" 
                                          class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-center font-medium transition">
                                        {{ $t('tenant.upgrade_plan') }}
                                    </Link>
                                    <Link :href="route('subscription.invoices')" 
                                          class="flex-1 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 px-4 py-2 rounded-lg text-center font-medium transition">
                                        {{ $t('tenant.invoices') }}
                                    </Link>
                                </div>
                            </div>

                            <div v-else class="p-6 text-center">
                                <p class="text-gray-500 dark:text-gray-400 mb-4">
                                    {{ $t('tenant.subscription_expired') }}
                                </p>
                                <Link :href="route('subscription.plans')" 
                                      class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition">
                                    {{ $t('tenant.select_plan') }}
                                </Link>
                            </div>
                        </div>

                        <!-- Usage Statistics -->
                        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                {{ $t('tenant.usage_statistics') }}
                            </h3>

                            <div class="space-y-4">
                                <!-- Patients Usage -->
                                <div>
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600 dark:text-gray-400">
                                            {{ $t('tenant.patients_usage') }}
                                        </span>
                                        <span class="font-medium text-gray-900 dark:text-gray-100">
                                            {{ usageStats.patients.current }} 
                                            <span v-if="!usageStats.patients.unlimited">
                                                / {{ usageStats.patients.limit }}
                                            </span>
                                            <span v-else class="text-green-600">
                                                ({{ $t('tenant.unlimited') }})
                                            </span>
                                        </span>
                                    </div>
                                    <div v-if="!usageStats.patients.unlimited" class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="h-2 rounded-full transition-all" 
                                             :class="usageStats.patients.percentage >= 90 ? 'bg-red-500' : usageStats.patients.percentage >= 70 ? 'bg-yellow-500' : 'bg-green-500'"
                                             :style="{ width: usageStats.patients.percentage + '%' }">
                                        </div>
                                    </div>
                                </div>

                                <!-- Doctors Usage -->
                                <div>
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600 dark:text-gray-400">
                                            {{ $t('tenant.doctors_usage') }}
                                        </span>
                                        <span class="font-medium text-gray-900 dark:text-gray-100">
                                            {{ usageStats.doctors.current }}
                                            <span v-if="!usageStats.doctors.unlimited">
                                                / {{ usageStats.doctors.limit }}
                                            </span>
                                            <span v-else class="text-green-600">
                                                ({{ $t('tenant.unlimited') }})
                                            </span>
                                        </span>
                                    </div>
                                    <div v-if="!usageStats.doctors.unlimited" class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="h-2 rounded-full transition-all"
                                             :class="usageStats.doctors.percentage >= 90 ? 'bg-red-500' : usageStats.doctors.percentage >= 70 ? 'bg-yellow-500' : 'bg-green-500'"
                                             :style="{ width: usageStats.doctors.percentage + '%' }">
                                        </div>
                                    </div>
                                </div>

                                <!-- Storage Usage -->
                                <div>
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600 dark:text-gray-400">
                                            {{ $t('tenant.storage_usage') }}
                                        </span>
                                        <span class="font-medium text-gray-900 dark:text-gray-100">
                                            {{ usageStats.storage.current }} {{ $t('tenant.mb') }}
                                            <span v-if="!usageStats.storage.unlimited">
                                                / {{ usageStats.storage.limit }} {{ $t('tenant.mb') }}
                                            </span>
                                            <span v-else class="text-green-600">
                                                ({{ $t('tenant.unlimited') }})
                                            </span>
                                        </span>
                                    </div>
                                    <div v-if="!usageStats.storage.unlimited" class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="h-2 rounded-full transition-all"
                                             :class="usageStats.storage.percentage >= 90 ? 'bg-red-500' : usageStats.storage.percentage >= 70 ? 'bg-yellow-500' : 'bg-green-500'"
                                             :style="{ width: usageStats.storage.percentage + '%' }">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Quick Info -->
                    <div class="space-y-6">
                        <!-- Subscription History -->
                        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                {{ $t('superadmin.subscription_history') }}
                            </h3>

                            <div v-if="subscriptionHistory && subscriptionHistory.length > 0" class="space-y-3">
                                <div v-for="sub in subscriptionHistory.slice(0, 5)" :key="sub.id" 
                                     class="border-l-4 pl-3 py-2"
                                     :class="sub.status === 'active' ? 'border-green-500' : 'border-gray-300'">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ sub.plan?.name }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ formatDate(sub.starts_at) }} - {{ formatDate(sub.ends_at) }}
                                    </div>
                                    <div class="text-xs">
                                        <span class="px-2 py-0.5 rounded"
                                              :class="sub.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'">
                                            {{ sub.status }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <p v-else class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $t('superadmin.no_subscriptions') }}
                            </p>
                        </div>

                        <!-- Quick Links -->
                        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                {{ $t('common.quick_actions') }}
                            </h3>

                            <div class="space-y-2">
                                <Link :href="route('subscription.plans')" 
                                      class="block px-4 py-2 text-sm text-indigo-600 hover:bg-indigo-50 dark:hover:bg-gray-700 rounded transition">
                                    {{ $t('tenant.compare_plans') }}
                                </Link>
                                <Link :href="route('subscription.invoices')" 
                                      class="block px-4 py-2 text-sm text-indigo-600 hover:bg-indigo-50 dark:hover:bg-gray-700 rounded transition">
                                    {{ $t('tenant.view_invoice') }}
                                </Link>
                                <a href="#" 
                                   class="block px-4 py-2 text-sm text-indigo-600 hover:bg-indigo-50 dark:hover:bg-gray-700 rounded transition">
                                    {{ $t('tenant.contact_support') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const page = usePage();
const $t = (key, params = {}) => {
    // Simple translation helper
    const translations = page.props.translations || {};
    let text = translations[key] || key;
    
    // Replace params
    Object.keys(params).forEach(param => {
        text = text.replace(`:${param}`, params[param]);
    });
    
    return text;
};

const props = defineProps({
    currentSubscription: Object,
    subscriptionHistory: Array,
    availablePlans: Array,
    usageStats: Object,
    daysRemaining: Number,
    isInTrial: Boolean,
    trialDaysRemaining: Number,
    tenant: Object,
});

const showWarning = computed(() => {
    return (props.isInTrial && props.trialDaysRemaining <= 7) || 
           props.daysRemaining <= 7;
});

const statusClass = computed(() => {
    if (!props.currentSubscription) return 'bg-gray-100 text-gray-800';
    
    const status = props.currentSubscription.status;
    return {
        'active': 'bg-green-100 text-green-800',
        'expired': 'bg-red-100 text-red-800',
        'cancelled': 'bg-gray-100 text-gray-800',
        'pending': 'bg-yellow-100 text-yellow-800',
    }[status] || 'bg-gray-100 text-gray-800';
});

const statusText = computed(() => {
    if (!props.currentSubscription) return t('tenant.subscription_expired');
    
    const status = props.currentSubscription.status;
    return {
        'active': t('superadmin.active'),
        'expired': t('tenant.subscription_expired'),
        'cancelled': t('superadmin.cancelled'),
        'pending': t('tenant.pending'),
    }[status] || status;
});

const formatDate = (date) => {
    if (!date) return '-';
    return new Date(date).toLocaleDateString('ar-MA', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};
</script>
