<?php

namespace InetStudio\Feedback\Observers;

use Illuminate\Support\Facades\Mail;
use InetStudio\Feedback\Models\FeedbackModel;

class FeedbackObserver
{
    /**
     * Listen to the FeedbackModel created event.
     *
     * @param FeedbackModel $feedback
     * @return void
     */
    public function created(FeedbackModel $feedback)
    {
        if (config('feedback.mails.to')) {
            Mail::send('admin.module.feedback::mails.feedback', ['feedback' => $feedback], function ($m) use ($feedback) {
                $subject = config('app.name').' | '.((config('feedback.mails.subject')) ? config('feedback.mails.subject') : 'Сообщение с формы обратной связи');

                $m->from(config('mail.from.address'), config('mail.from.name'))
                    ->to(config('feedback.mails.to'), '')
                    ->subject($subject);
            });
        }
    }
}
