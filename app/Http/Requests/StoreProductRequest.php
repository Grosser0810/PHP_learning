<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required',
            'url'     => 'required',
            'image'   => 'required',
            'content' => 'required',
            'price'   => 'required'

        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute не заполнено'
        ];
    }

    public function attributes()
    {
            return [
                'name'    => '\'Имя продукта\'',
                'url'     => '\'Ссылка продукта\'',
                'image'   => '\'Картинка продукта\'',
                'content' => '\'Описаниепродукта\'',
                'price'   => '\'Цена продукта\''
            ];
    }
}
