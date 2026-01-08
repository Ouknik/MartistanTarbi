<?php

namespace App\Notifications;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentConfirmationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $subscription;
    protected $amount;
    protected $paymentReference;

    /**
     * Create a new notification instance.
     */
    public function __construct(Subscription $subscription, float $amount, string $paymentReference)
    {
        $this->subscription = $subscription;
        $this->amount = $amount;
        $this->paymentReference = $paymentReference;
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
        $dashboardUrl = 'http://' . $this->subscription->tenant->domains->first()->domain . '.' . config('tenancy.central_domains')[0] . ':9010/dashboard';
        
        return (new MailMessage)
            ->subject('✅ تم تأكيد دفعتك بنجاح')
            ->greeting('مرحباً ' . $this->subscription->tenant->name . ',')
            ->line('شكراً لك! تم استلام دفعتك وتأكيدها بنجاح.')
            ->line('')
            ->line('**تفاصيل الدفع:**')
            ->line('💰 المبلغ: ' . number_format($this->amount, 2) . ' ' . $this->subscription->currency)
            ->line('📦 الخطة: ' . $this->subscription->plan?->name)
            ->line('🔖 رقم المرجع: ' . $this->paymentReference)
            ->line('📅 تاريخ الدفع: ' . now()->format('Y-m-d H:i'))
            ->line('')
            ->line('**فترة الاشتراك الجديدة:**')
            ->line('🗓️ من: ' . $this->subscription->starts_at?->format('Y-m-d'))
            ->line('🗓️ إلى: ' . $this->subscription->ends_at?->format('Y-m-d'))
            ->line('')
            ->line('✨ اشتراكك نشط الآن ويمكنك الاستمتاع بجميع ميزات النظام.')
            ->line('')
            ->action('انتقل إلى لوحة التحكم', $dashboardUrl)
            ->line('إذا كان لديك أي استفسار، يرجى عدم التردد في التواصل معنا.')
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
            'amount' => $this->amount,
            'payment_reference' => $this->paymentReference,
            'paid_at' => now(),
        ];
    }
}
