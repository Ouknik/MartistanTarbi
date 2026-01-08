<?php

namespace App\Notifications;

use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TrialEndingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $tenant;
    protected $daysRemaining;

    /**
     * Create a new notification instance.
     */
    public function __construct(Tenant $tenant, int $daysRemaining)
    {
        $this->tenant = $tenant;
        $this->daysRemaining = $daysRemaining;
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
        $subscribeUrl = 'http://' . $this->tenant->domains->first()->domain . '.' . config('tenancy.central_domains')[0] . ':9010/subscription/plans';
        
        return (new MailMessage)
            ->subject('⏰ فترة التجربة المجانية على وشك الانتهاء')
            ->greeting('مرحباً ' . $this->tenant->name . ',')
            ->line('نأمل أن تكون قد استمتعت بتجربة مريستان!')
            ->line('')
            ->line('نود تذكيرك بأن فترة التجربة المجانية الخاصة بك على وشك الانتهاء.')
            ->line('')
            ->line('⏰ **الوقت المتبقي:** ' . $this->daysRemaining . ' ' . ($this->daysRemaining == 1 ? 'يوم' : 'أيام'))
            ->line('📅 **تاريخ الانتهاء:** ' . $this->tenant->trial_ends_at?->format('Y-m-d'))
            ->line('')
            ->line('لمواصلة استخدام النظام والاستفادة من جميع المميزات، يرجى اختيار الخطة المناسبة لك.')
            ->line('')
            ->line('✨ **مميزات الاشتراك:**')
            ->line('• وصول كامل وغير محدود')
            ->line('• دعم فني متواصل')
            ->line('• تحديثات مستمرة')
            ->line('• نسخ احتياطي تلقائي')
            ->line('')
            ->action('اختر خطتك الآن', $subscribeUrl)
            ->line('في حالة عدم الاشتراك، سيتم تعليق حسابك بعد انتهاء فترة التجربة.')
            ->salutation('مع تحياتنا، فريق مريستان');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'tenant_id' => $this->tenant->id,
            'tenant_name' => $this->tenant->name,
            'days_remaining' => $this->daysRemaining,
            'trial_ends_at' => $this->tenant->trial_ends_at,
        ];
    }
}
