<?php
namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class SendTelegramNotification
{
    protected Api $telegram;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    /**
     * Handle the event.
     *
     * @param UserRegistered $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        try {
            $user = $event->user;

            $message = "🆕 Yeni Kullanıcı Kaydı!\n\n";
            $message .= "👤 İsim: " . $user->name . "\n";
            $message .= "📧 E-posta: " . $user->email . "\n";
            $message .= "📅 Kayıt Tarihi: " . $user->created_at->format('d.m.Y H:i:s');

            $this->telegram->sendMessage([
                'chat_id' => env('TELEGRAM_CHAT_ID'),
                'text' => $message,
                'parse_mode' => 'HTML',
            ]);
        } catch (\Exception $e) {
            Log::error('Telegram Hatası: ' . $e->getMessage());
        }
    }
}
