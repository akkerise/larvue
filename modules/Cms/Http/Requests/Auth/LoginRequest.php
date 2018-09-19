<?php
namespace Modules\Cms\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|between:6,32',
            'password' => 'required|between:6,32'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Bạn nên nhập vào email !',
            'email.between' => 'Email của bạn không nằm trong khoảng ký tự :min -> :max ký tự !',
            'password.required' => 'Bạn nên nhập vào mật khẩu !',
            'password.between' => 'Mật khẩu của bạn không nằm trong khoảng ký tự :min -> :max ký tự !'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}