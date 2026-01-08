<?php

namespace App\Notifications;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionExpiredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $subscription;

    /**
     * Create a new notification instance.
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
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
        
        return (new MailMessage)
            ->subject('🔴 اشتراكك قد انتهى - تم تعليق الحساب')
            ->greeting('مرحباً ' . $this->subscription->tenant->name . ',')
            ->line('نأسف لإبلاغك بأن اشتراكك في مريستان قد انتهى.')
            ->line('')
            ->line('**تفاصيل الاشتراك المنتهي:**')
            ->line('📦 الخطة: ' . $this->subscription->plan?->name)
            ->line('📅 تاريخ الانتهاء: ' . $this->subscription->ends_at?->format('Y-m-d'))
            ->line('')
            ->line('🔒 **تم تعليق حسابك مؤقتاً**')
            ->line('لن تتمكن من الوصول إلى النظام حتى يتم تجديد الاشتراك.')
            ->line('')
            ->line('جميع بياناتك محفوظة بأمان ويمكنك استعادة الوصول في أي وقت عن طريق تجديد اشتراكك.')
            ->line('')
            ->action('تجديد الاشتراك الآن', $renewUrl)
            ->line('إذا كنت تواجه أي مشكلة، يرجى التواصل معنا.')
            ->salutation('مع تحياتنا، فريق مريستان');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'subscription_id' => $this->subscription->id,
            'tenant_name' => $this->subscription->tenant->name,
            'expired_at' => $this->subscription->ends_at,
        ];
    }
}
