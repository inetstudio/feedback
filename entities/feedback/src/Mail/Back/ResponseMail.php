<?php

namespace InetStudio\FeedbackPackage\Feedback\Mail\Back;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\FeedbackPackage\Feedback\Contracts\Models\FeedbackModelContract;
use InetStudio\FeedbackPackage\Feedback\Contracts\Mail\Back\ResponseMailContract;

/**
 * Class ResponseMail.
 */
class ResponseMail extends Mailable implements ResponseMailContract
{
    use SerializesModels;

    /**
     * @var FeedbackModelContract
     */
    protected $item;

    /**
     * ResponseMail constructor.
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
        $subject = config('app.name').' | '.config('feedback.mails_users.subject', 'Ответ на вопрос');
        $headers = config('feedback.mails_users.headers', []);

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->to($this->item['email'], $this->item['name'])
            ->subject($subject)
            ->withSwiftMessage(function ($message) use ($headers) {
                $messageHeaders = $message->getHeaders();

                foreach ($headers as $header => $value) {
                    $messageHeaders->addTextHeader($header, $value);
                }
            })
            ->view('admin.module.feedback::mails.feedback_response', ['item' => $this->item]);
    }
}
