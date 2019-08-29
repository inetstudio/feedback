<?php

namespace InetStudio\FeedbackPackage\Feedback\Mail\Front;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Mail\Front\NewItemMailContract;

/**
 * Class NewItemMail.
 */
class NewItemMail extends Mailable implements NewItemMailContract
{
    use SerializesModels;

    /**
     * @var FeedbackModelContract
     */
    protected $item;

    /**
     * NewFeedbackMail constructor.
     *
     * @param  FeedbackModelContract  $item
     */
    public function __construct(FeedbackModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        $subject = config('app.name').' | '.config('feedback.mails_admins.subject', 'Сообщение с формы обратной связи');
        $headers = config('feedback.mails_admins.headers', []);

        $to = config('feedback.mails_admins.to');

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->to($to)
            ->subject($subject)
            ->withSwiftMessage(function ($message) use ($headers) {
                $messageHeaders = $message->getHeaders();

                foreach ($headers as $header => $value) {
                    $messageHeaders->addTextHeader($header, $value);
                }
            })
            ->view('admin.module.feedback::mails.feedback_admins', ['item' => $this->item]);
    }
}
