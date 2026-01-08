<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    tenant: Object,
    loginUrl: String,
});
</script>

<template>
    <Head title="تم إنشاء العيادة بنجاح" />
    
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-indigo-50 flex items-center justify-center" dir="rtl">
        <div class="max-w-lg w-full mx-4">
            <!-- Success Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
                <!-- Success Icon -->
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <h1 class="text-3xl font-bold text-gray-800 mb-2">تهانينا! 🎉</h1>
                <p class="text-gray-600 mb-6">تم إنشاء عيادتك بنجاح وهي جاهزة للاستخدام</p>

                <!-- Tenant Info -->
                <div class="bg-gray-50 rounded-xl p-6 mb-6 text-right">
                    <h3 class="font-bold text-gray-800 mb-4">معلومات عيادتك</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">اسم العيادة:</span>
                            <span class="font-medium">{{ tenant.data?.name || tenant.id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">رابط العيادة:</span>
                            <a :href="loginUrl" class="font-medium text-indigo-600 hover:underline" target="_blank">
                                {{ tenant.domains?.[0]?.domain }}.maristan.app
                            </a>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">الفترة التجريبية:</span>
                            <span class="font-medium text-green-600">
                                {{ tenant.trial_ends_at ? `حتى ${new Date(tenant.trial_ends_at).toLocaleDateString('ar-MA')}` : '14 يوم' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-indigo-50 rounded-xl p-6 mb-6 text-right">
                    <h3 class="font-bold text-indigo-800 mb-3">الخطوات التالية</h3>
                    <ul class="space-y-2 text-sm text-indigo-700">
                        <li class="flex items-center">
                            <span class="w-6 h-6 bg-indigo-200 rounded-full flex items-center justify-center ml-2 text-xs font-bold">1</span>
                            قم بالدخول إلى لوحة التحكم باستخدام بياناتك
                        </li>
                        <li class="flex items-center">
                            <span class="w-6 h-6 bg-indigo-200 rounded-full flex items-center justify-center ml-2 text-xs font-bold">2</span>
                            أضف معلومات الأطباء والتخصصات
                        </li>
                        <li class="flex items-center">
                            <span class="w-6 h-6 bg-indigo-200 rounded-full flex items-center justify-center ml-2 text-xs font-bold">3</span>
                            ابدأ بإضافة المرضى والمواعيد
                        </li>
                    </ul>
                </div>

                <!-- Actions -->
                <div class="space-y-3">
                    <a
                        :href="loginUrl"
                        target="_blank"
                        class="block w-full py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-colors font-medium"
                    >
                        الدخول إلى لوحة التحكم
                    </a>
                    <Link
                        :href="route('register.tenant')"
                        class="block w-full py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors"
                    >
                        إنشاء عيادة أخرى
                    </Link>
                </div>
            </div>

            <!-- Help -->
            <p class="text-center text-gray-500 text-sm mt-6">
                هل تحتاج مساعدة؟ 
                <a href="mailto:support@maristan.app" class="text-indigo-600 hover:underline">تواصل معنا</a>
            </p>
        </div>
    </div>
</template>
