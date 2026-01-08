<?php

namespace App\Notifications;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionExpiringNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $subscription;
    protected $daysRemaining;

    /**
     * Create a new notification instance.
     */
    public function __construct(Subscription $subscription, int $daysRemaining)
    {
        $this->subscription = $subscription;
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
        $renewUrl = 'http://' . $this->subscription->tenant->domains->first()->domain . '.' . config('tenancy.central_domains')[0] . ':9010/subscription/renew';
        
        $message = (new MailMessage)
            ->subject('⚠️ تنبيه: اشتراكك على وشك الانتهاء')
            ->greeting('مرحباً ' . $this->subscription->tenant->name . ',')
            ->line('نود تذكيرك بأن اشتراكك في مريستان على وشك الانتهاء.')
            ->line('')
            ->line('**معلومات الاشتراك:**')
            ->line('📦 الخطة: ' . $this->subscription->plan?->name)
            ->line('📅 تاريخ الانتهاء: ' . $this->subscription->ends_at?->format('Y-m-d'))
            ->line('⏰ الوقت المتبقي: ' . $this->daysRemaining . ' ' . ($this->daysRemaining == 1 ? 'يوم' : 'أيام'))
            ->line('');

        if ($this->daysRemaining <= 3) {
            $message->line('🚨 **تحذير**: اشتراكك على وشك الانتهاء قريباً جداً!');
            $message->line('يرجى تجديد اشتراكك لتجنب انقطاع الخدمة.');
        } else {
            $message->line('يرجى تجديد اشتراكك لضمان استمرار الخدمة دون انقطاع.');
        }

        $message->line('')
            ->action('تجديد الاشتراك الآن', $renewUrl)
            ->line('في حالة عدم التجديد، سيتم تعليق حسابك بعد انتهاء الاشتراك.')
            ->salutation('مع تحياتنا، فريق مريستان');

        return $message;
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'subscription_id' => $this->subscription->id,
            'tenant_name' => $this->subscription->tenant->name,
            'days_remaining' => $this->daysRemaining,
            'ends_at' => $this->subscription->ends_at,
        ];
    }
}
