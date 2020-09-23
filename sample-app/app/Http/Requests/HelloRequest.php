<?php

namespace App\Http\Requests;

use App\Rules\MyRule;
use Illuminate\Foundation\Http\FormRequest;

class HelloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'hello')
            return true;
        else
            return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'mail' => 'email',
            'age' => ['numeric', new MyRule(5)],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力して下さい。',
            'mail.email' => 'メールアドレスを入力して下さい。',
            'age.numeric' => '年齢は整数で入力して下さい。',
            'age.hello' => 'Hello!入力は偶数のみだよん！',
        ];
    }
}
