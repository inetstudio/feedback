<?php

namespace InetStudio\Feedback\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\Feedback\Contracts\Http\Requests\Back\SaveFeedbackRequestContract;

/**
 * Class SaveFeedbackRequest.
 */
class SaveFeedbackRequest extends FormRequest implements SaveFeedbackRequestContract
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Сообщения об ошибках.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'message.required' => 'Поле «Сообщение» обязательно для заполнения',

            'name.required' => 'Поле «Имя» обязательно для заполнения',
            'name.max' => 'Поле «Имя» не должно превышать 255 символов',

            'email.required' => 'Поле «Email» обязательно для заполнения',
            'email.max' => 'Поле «Email» не должно превышать 255 символов',
            'email.email' => 'Поле «Email» должно содержать значение в корректном формате',
        ];
    }

    /**
     * Правила проверки запроса.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'message' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
        ];

        return $rules;
    }
}
