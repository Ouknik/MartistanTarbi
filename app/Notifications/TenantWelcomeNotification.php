<?php

namespace App\Notifications;

use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TenantWelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $tenant;
    protected $adminPassword;

    /**
     * Create a new notification instance.
     */
    public function __construct(Tenant $tenant, string $adminPassword)
    {
        $this->tenant = $tenant;
        $this->adminPassword = $adminPassword;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        // Get tenant subdomain and build full URL
        $subdomain = $this->tenant->domains->first()->domain;
        $centralDomain = config('tenancy.central_domains')[0] ?? env('CENTRAL_DOMAIN', 'maristan.local');
        $port = env('APP_PORT', '9010');
        $loginUrl = 'http://' . $subdomain . '.' . $centralDomain . ':' . $port . '/login';
        
        $planName = $this->tenant->plan?->name ?? 'الخطة الأساسية';
        $trialDays = $this->tenant->trial_ends_at 
            ? $this->tenant->trial_ends_at->diffInDays(now()) 
            : 14;
        
        return (new MailMessage)
            ->subject('🎉 مرحباً بك في مريستان - تم إنشاء عيادتك بنجاح!')
            ->greeting('مرحباً بك في **' . $this->tenant->name . '**! 👋')
            ->line('نحن سعداء جداً بانضمامك إلى منصة **مريستان SaaS** لإدارة العيادات الطبية.')
            ->line('تم إنشاء عيادتك بنجاح ويمكنك الآن البدء باستخدام جميع مميزات النظام.')
            ->line('')
            ->line('---')
            ->line('## 🔐 معلومات تسجيل الدخول')
            ->line('**🔗 رابط تسجيل الدخول:**')
            ->line($loginUrl)
            ->line('**📧 البريد الإلكتروني:** ' . $this->tenant->email)
            ->line('**🔑 كلمة المرور:** `' . $this->adminPassword . '`')
            ->line('')
            ->line('⚠️ **مهم جداً:** يُرجى تغيير كلمة المرور فوراً بعد أول تسجيل دخول من أجل الأمان.')
            ->line('---')
            ->line('')
            ->line('## 📊 معلومات الاشتراك')
            ->line('**📦 الخطة الحالية:** ' . $planName)
            ->line('**🎁 مدة التجربة المجانية:** ' . $trialDays . ' يوم')
            ->line('**📅 تنتهي التجربة في:** ' . ($this->tenant->trial_ends_at ? $this->tenant->trial_ends_at->format('Y-m-d') : 'غير محدد'))
            ->line('')
            ->action('🚀 تسجيل الدخول الآن', $loginUrl)
            ->line('')
            ->line('---')
            ->line('## 💡 نصائح للبدء')
            ->line('1. ✅ قم بتسجيل الدخول وتغيير كلمة المرور')
            ->line('2. ⚙️ أكمل إعدادات العيادة من لوحة التحكم')
            ->line('3. 👥 أضف الأطباء والموظفين')
            ->line('4. 🏥 ابدأ بإضافة المرضى والمواعيد')
            ->line('')
            ->line('---')
            ->line('## 📞 هل تحتاج مساعدة؟')
            ->line('فريق الدعم جاهز لمساعدتك في أي وقت!')
            ->line('📧 البريد: support@maristan.com')
            ->line('📱 الهاتف: +212 XXX XXX XXX')
            ->line('')
            ->salutation('مع أطيب التمنيات بالنجاح، 🌟\n\n**فريق مريستان**');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'tenant_id' => $this->tenant->id,
            'tenant_name' => $this->tenant->name,
            'message' => 'تم إنشاء عيادة جديدة',
        ];
    }
}
