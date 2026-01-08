<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    plans: Array,
});

const step = ref(1);
const selectedPlan = ref(null);

const form = useForm({
    // Clinic Info
    clinic_name: '',
    clinic_email: '',
    clinic_phone: '',
    subdomain: '',
    city: '',
    // Admin Info
    admin_name: '',
    admin_email: '',
    admin_password: '',
    admin_password_confirmation: '',
    // Plan
    plan_id: null,
    // Terms
    accept_terms: false,
});

const selectPlan = (plan) => {
    selectedPlan.value = plan;
    form.plan_id = plan.id;
    step.value = 2;
};

const goToStep = (s) => {
    if (s < step.value) {
        step.value = s;
    }
};

const nextStep = () => {
    if (step.value === 2) {
        // Validate clinic info
        if (!form.clinic_name || !form.clinic_email || !form.subdomain) {
            return;
        }
        step.value = 3;
    }
};

const prevStep = () => {
    if (step.value > 1) {
        step.value--;
    }
};

const submit = () => {
    form.post(route('register.tenant.store'));
};

const subdomainPreview = computed(() => {
    return form.subdomain ? `${form.subdomain}.maristan.app` : 'yourname.maristan.app';
});
</script>

<template>
    <Head title="تسجيل عيادة جديدة" />
    
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50" dir="rtl">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-800">مريستان</span>
                </div>
                <Link :href="route('superadmin.login')" class="text-indigo-600 hover:text-indigo-800">
                    تسجيل دخول الإدارة
                </Link>
            </div>
        </header>

        <main class="max-w-4xl mx-auto px-4 py-12">
            <!-- Progress Steps -->
            <div class="flex items-center justify-center mb-12">
                <div 
                    v-for="s in 3" 
                    :key="s" 
                    class="flex items-center"
                >
                    <button
                        @click="goToStep(s)"
                        :class="[
                            'w-10 h-10 rounded-full flex items-center justify-center font-bold transition-colors',
                            step >= s ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-500'
                        ]"
                    >
                        {{ s }}
                    </button>
                    <div 
                        v-if="s < 3"
                        :class="[
                            'w-24 h-1 mx-2',
                            step > s ? 'bg-indigo-600' : 'bg-gray-200'
                        ]"
                    />
                </div>
            </div>

            <!-- Step Labels -->
            <div class="flex justify-center gap-16 mb-8 text-sm">
                <span :class="step >= 1 ? 'text-indigo-600 font-medium' : 'text-gray-400'">اختر الخطة</span>
                <span :class="step >= 2 ? 'text-indigo-600 font-medium' : 'text-gray-400'">معلومات العيادة</span>
                <span :class="step >= 3 ? 'text-indigo-600 font-medium' : 'text-gray-400'">حساب المدير</span>
            </div>

            <!-- Step 1: Select Plan -->
            <div v-show="step === 1" class="space-y-8">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-800">اختر خطة الاشتراك المناسبة</h1>
                    <p class="text-gray-500 mt-2">يمكنك تجربة أي خطة مجاناً لمدة 14 يوماً</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div
                        v-for="plan in plans"
                        :key="plan.id"
                        @click="selectPlan(plan)"
                        :class="[
                            'bg-white rounded-2xl shadow-lg overflow-hidden cursor-pointer transition-all hover:scale-105',
                            selectedPlan?.id === plan.id ? 'ring-2 ring-indigo-600' : ''
                        ]"
                    >
                        <div
                            class="p-6 text-center"
                            :class="{
                                'bg-gray-100': plan.name === 'Free',
                                'bg-blue-500 text-white': plan.name === 'Basic',
                                'bg-purple-500 text-white': plan.name === 'Pro',
                                'bg-gradient-to-r from-yellow-500 to-orange-500 text-white': plan.name === 'Enterprise',
                            }"
                        >
                            <h3 class="text-xl font-bold">{{ plan.name }}</h3>
                            <p class="text-3xl font-bold mt-2">
                                {{ plan.price_monthly === 0 ? 'مجاني' : plan.price_monthly?.toLocaleString() }}
                                <span v-if="plan.price_monthly > 0" class="text-sm font-normal">درهم/شهر</span>
                            </p>
                        </div>

                        <div class="p-6">
                            <ul class="space-y-3 text-sm">
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ plan.max_doctors || '∞' }} أطباء
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ plan.max_patients || '∞' }} مريض
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ plan.max_storage || '∞' }} GB تخزين
                                </li>
                            </ul>

                            <button
                                class="w-full mt-6 py-3 rounded-lg font-medium transition-colors"
                                :class="{
                                    'bg-indigo-600 text-white hover:bg-indigo-700': selectedPlan?.id !== plan.id,
                                    'bg-green-600 text-white': selectedPlan?.id === plan.id,
                                }"
                            >
                                {{ selectedPlan?.id === plan.id ? 'تم الاختيار ✓' : 'اختر هذه الخطة' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Clinic Info -->
            <div v-show="step === 2" class="max-w-xl mx-auto">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">معلومات العيادة</h1>
                    <p class="text-gray-500 mt-2">أدخل بيانات عيادتك</p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8 space-y-6">
                    <!-- Clinic Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">اسم العيادة *</label>
                        <input
                            v-model="form.clinic_name"
                            type="text"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="عيادة الشفاء"
                        />
                        <p v-if="form.errors.clinic_name" class="mt-1 text-sm text-red-600">{{ form.errors.clinic_name }}</p>
                    </div>

                    <!-- Subdomain -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">عنوان العيادة (Subdomain) *</label>
                        <div class="flex">
                            <input
                                v-model="form.subdomain"
                                type="text"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-r-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="alshifa"
                            />
                            <span class="inline-flex items-center px-4 bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg text-gray-500 text-sm">
                                .maristan.app
                            </span>
                        </div>
                        <p class="mt-1 text-sm text-indigo-600">عنوان عيادتك: {{ subdomainPreview }}</p>
                        <p v-if="form.errors.subdomain" class="mt-1 text-sm text-red-600">{{ form.errors.subdomain }}</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني للعيادة *</label>
                        <input
                            v-model="form.clinic_email"
                            type="email"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="info@clinic.com"
                        />
                        <p v-if="form.errors.clinic_email" class="mt-1 text-sm text-red-600">{{ form.errors.clinic_email }}</p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">رقم الهاتف</label>
                        <input
                            v-model="form.clinic_phone"
                            type="tel"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="0550000000"
                        />
                    </div>

                    <!-- City -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">المدينة</label>
                        <input
                            v-model="form.city"
                            type="text"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="الجزائر"
                        />
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-between pt-4">
                        <button
                            type="button"
                            @click="prevStep"
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50"
                        >
                            السابق
                        </button>
                        <button
                            type="button"
                            @click="nextStep"
                            class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
                        >
                            التالي
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 3: Admin Account -->
            <div v-show="step === 3" class="max-w-xl mx-auto">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">حساب مدير العيادة</h1>
                    <p class="text-gray-500 mt-2">أنشئ حساب المدير للدخول إلى لوحة التحكم</p>
                </div>

                <form @submit.prevent="submit" class="bg-white rounded-2xl shadow-lg p-8 space-y-6">
                    <!-- Admin Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">اسم المدير *</label>
                        <input
                            v-model="form.admin_name"
                            type="text"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="محمد أحمد"
                            required
                        />
                        <p v-if="form.errors.admin_name" class="mt-1 text-sm text-red-600">{{ form.errors.admin_name }}</p>
                    </div>

                    <!-- Admin Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني *</label>
                        <input
                            v-model="form.admin_email"
                            type="email"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="admin@clinic.com"
                            required
                        />
                        <p v-if="form.errors.admin_email" class="mt-1 text-sm text-red-600">{{ form.errors.admin_email }}</p>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">كلمة المرور *</label>
                        <input
                            v-model="form.admin_password"
                            type="password"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="••••••••"
                            required
                        />
                        <p v-if="form.errors.admin_password" class="mt-1 text-sm text-red-600">{{ form.errors.admin_password }}</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">تأكيد كلمة المرور *</label>
                        <input
                            v-model="form.admin_password_confirmation"
                            type="password"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="••••••••"
                            required
                        />
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start">
                        <input
                            v-model="form.accept_terms"
                            type="checkbox"
                            id="accept_terms"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mt-1"
                            required
                        />
                        <label for="accept_terms" class="mr-3 block text-sm text-gray-700">
                            أوافق على <a href="#" class="text-indigo-600 hover:underline">شروط الاستخدام</a> و 
                            <a href="#" class="text-indigo-600 hover:underline">سياسة الخصوصية</a>
                        </label>
                    </div>

                    <!-- Summary -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-medium text-gray-800 mb-2">ملخص الاشتراك</h4>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p><span class="font-medium">الخطة:</span> {{ selectedPlan?.name }}</p>
                            <p><span class="font-medium">العيادة:</span> {{ form.clinic_name || '-' }}</p>
                            <p><span class="font-medium">الرابط:</span> {{ subdomainPreview }}</p>
                            <p><span class="font-medium">الفترة التجريبية:</span> {{ selectedPlan?.trial_days || 14 }} يوم مجاناً</p>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-between pt-4">
                        <button
                            type="button"
                            @click="prevStep"
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50"
                        >
                            السابق
                        </button>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 disabled:opacity-50"
                        >
                            <span v-if="form.processing">جاري إنشاء العيادة...</span>
                            <span v-else>إنشاء العيادة 🚀</span>
                        </button>
                    </div>
                </form>
            </div>
        </main>

        <!-- Footer -->
        <footer class="py-8 text-center text-gray-500 text-sm">
            © {{ new Date().getFullYear() }} مريستان - جميع الحقوق محفوظة
        </footer>
    </div>
</template>
