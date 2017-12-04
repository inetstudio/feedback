<?php

namespace InetStudio\Feedback\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\Feedback\Models\FeedbackModel;

class NewFeedbackMail extends Mailable
{
    use SerializesModels;

    protected $feedback;

    /**
     * NewFeedbackMail constructor.
     *
     * @param FeedbackModel $feedback
     */
    public function __construct(FeedbackModel $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): NewFeedbackMail
    {
        $subject = config('app.name').' | '.((config('feedback.mails.subject')) ? config('feedback.mails.subject') : 'Сообщение с формы обратной связи');
        $headers = (config('feedback.mails.headers')) ? config('feedback.mails.headers') : [];

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->to(config('feedback.mails.to'), '')
            ->subject($subject)
            ->withSwiftMessage(function ($message) use ($headers) {
                $messageHeaders = $message->getHeaders();

                foreach ($headers as $header => $value) {
                    $messageHeaders->addTextHeader($header, $value);
                }
            })
            ->view('admin.module.feedback::mails.feedback', ['feedback' => $this->feedback]);
    }
}
