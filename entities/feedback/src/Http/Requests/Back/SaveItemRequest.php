<?php

namespace InetStudio\FeedbackPackage\Feedback\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\FeedbackPackage\Feedback\Contracts\Http\Requests\Back\SaveItemRequestContract;

/**
 * Class SaveItemRequest.
 */
class SaveItemRequest extends FormRequest implements SaveItemRequestContract
{
    /**
     * Определить, авторизован ли пользователь для этого запроса.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'response.required' => 'Поле «Ответ» обязательно для заполнения',
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
            'response' => 'required',
        ];

        return $rules;
    }
}
