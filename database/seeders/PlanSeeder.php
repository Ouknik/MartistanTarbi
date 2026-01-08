<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'مجاني',
                'slug' => 'free',
                'description' => 'خطة مجانية للتجربة',
                'price_monthly' => 0,
                'price_yearly' => 0,
                'max_doctors' => 1,
                'max_patients' => 50,
                'max_storage_mb' => 100,
                'features' => [
                    'basic_consultations',
                    'basic_appointments',
                    'basic_billing',
                ],
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'أساسي',
                'slug' => 'basic',
                'description' => 'للعيادات الصغيرة',
                'price_monthly' => 200,
                'price_yearly' => 2000,
                'max_doctors' => 2,
                'max_patients' => 500,
                'max_storage_mb' => 1000,
                'features' => [
                    'basic_consultations',
                    'basic_appointments',
                    'basic_billing',
                    'basic_echography',
                    'monthly_statistics',
                    'email_support',
                ],
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 2,
            ],
            [
                'name' => 'احترافي',
                'slug' => 'pro',
                'description' => 'للعيادات المتوسطة',
                'price_monthly' => 500,
                'price_yearly' => 5000,
                'max_doctors' => 5,
                'max_patients' => -1, // unlimited
                'max_storage_mb' => 5000,
                'features' => [
                    'basic_consultations',
                    'basic_appointments',
                    'basic_billing',
                    'all_echography_types',
                    'advanced_statistics',
                    'operations_management',
                    'certificates',
                    'driving_license',
                    'priority_support',
                    'data_export',
                ],
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'مؤسسي',
                'slug' => 'enterprise',
                'description' => 'للمؤسسات الطبية الكبيرة',
                'price_monthly' => 1000,
                'price_yearly' => 10000,
                'max_doctors' => -1, // unlimited
                'max_patients' => -1, // unlimited
                'max_storage_mb' => -1, // unlimited
                'features' => [
                    'basic_consultations',
                    'basic_appointments',
                    'basic_billing',
                    'all_echography_types',
                    'advanced_statistics',
                    'operations_management',
                    'certificates',
                    'driving_license',
                    'priority_support',
                    'data_export',
                    'api_access',
                    'custom_domain',
                    'white_label',
                    'dedicated_support',
                    'custom_integrations',
                ],
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 4,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
