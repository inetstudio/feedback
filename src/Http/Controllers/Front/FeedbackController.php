<?php

namespace InetStudio\Feedback\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use InetStudio\Feedback\Contracts\Services\Front\FeedbackServiceContract;
use InetStudio\Feedback\Contracts\Http\Responses\Front\SendFeedbackResponseContract;

/**
 * Class FeedbackController.
 */
class FeedbackController extends Controller
{
    /**
     * Отправляем сообщение с формы обратной связи.
     *
     * @param FeedbackServiceContract $feedbackService
     * @param Request $request
     *
     * @return SendFeedbackResponseContract
     */
    public function sendFeedback(FeedbackServiceContract $feedbackService, Request $request): SendFeedbackResponseContract
    {
        $rules = [
            'message' => 'required',
        ];

        if (! auth()->user()) {
            $rules = array_merge($rules, [
                'name' => 'required|max:255',
                'email' => 'required|max:255|email',
                'g-recaptcha-response' => [
                    'required',
                    new CaptchaRule,
                ],
            ]);
        }

        Validator::make($request->all(), $rules, [
            'message.required' => 'Поле «Сообщение» обязательно для заполнения',
            'name.required' => 'Поле «Имя» обязательно для заполнения',
            'name.max' => 'Поле «Имя» не должно превышать 255 символов',
            'email.required' => 'Поле «Email» обязательно для заполнения',
            'email.max' => 'Поле «Email» не должно превышать 255 символов',
            'email.email' => 'Поле «Email» должно содержать значение в корректном формате',
            'g-recaptcha-response.required' => 'Поле «Капча» обязательно для заполнения',
            'g-recaptcha-response.captcha'  => 'Неверный код капча',
        ])->validate();

        $data = $request->only($feedbackService->model->getFillable());

        $item = $feedbackService->sendFeedback($data);

        $result = ($item && isset($item->id));

        return app()->makeWith(SendFeedbackResponseContract::class, compact('result'));
    }
}
