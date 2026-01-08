<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Starter',
                'slug' => 'starter',
                'description' => 'مثالي للعيادات الصغيرة والناشئة',
                'price_monthly' => 299.00,
                'price_yearly' => 2990.00, // ~10 months
                'currency' => 'MAD',
                'trial_days' => 14,
                'max_doctors' => 2,
                'max_patients' => 500,
                'max_storage_mb' => 5120, // 5 GB
                'features' => [
                    'إدارة المرضى والملفات الطبية',
                    'جدولة المواعيد',
                    'إصدار الفواتير',
                    'تقارير أساسية',
                    'نسخ احتياطي يومي',
                    'دعم فني عبر البريد',
                ],
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'Professional',
                'slug' => 'professional',
                'description' => 'الأكثر شعبية للعيادات المتوسطة',
                'price_monthly' => 599.00,
                'price_yearly' => 5990.00, // ~10 months
                'currency' => 'MAD',
                'trial_days' => 14,
                'max_doctors' => 5,
                'max_patients' => 2000,
                'max_storage_mb' => 20480, // 20 GB
                'features' => [
                    'جميع مميزات Starter',
                    'إدارة متعددة الأطباء',
                    'الصور الطبية والأشعة',
                    'تقارير تفصيلية متقدمة',
                    'إدارة المخزون والأدوية',
                    'تذكير تلقائي بالمواعيد (SMS)',
                    'دعم فني أولوية',
                    'تكامل API',
                ],
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Enterprise',
                'slug' => 'enterprise',
                'description' => 'للمستشفيات والمراكز الطبية الكبيرة',
                'price_monthly' => 1299.00,
                'price_yearly' => 12990.00, // ~10 months
                'currency' => 'MAD',
                'trial_days' => 30,
                'max_doctors' => 0, // Unlimited
                'max_patients' => 0, // Unlimited
                'max_storage_mb' => 0, // Unlimited
                'features' => [
                    'جميع مميزات Professional',
                    'عدد غير محدود من الأطباء والمرضى',
                    'مساحة تخزين غير محدودة',
                    'إدارة متعددة الفروع',
                    'لوحة تحكم تحليلية متقدمة',
                    'تقارير مخصصة',
                    'نسخ احتياطي كل 6 ساعات',
                    'دعم فني مخصص 24/7',
                    'تدريب مجاني للفريق',
                    'SLA مضمون 99.9%',
                ],
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($plans as $planData) {
            Plan::updateOrCreate(
                ['slug' => $planData['slug']],
                $planData
            );
        }

        $this->command->info('✅ Plans seeded successfully!');
    }
}
