<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGoalWeightRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 認証は許可する
    }

    public function rules()
    {
        return [
            'goal_weight' => 'required|numeric|regex:/^\d+(\.\d{1})?$/', // 数値、小数点1桁まで
        ];
    }

    public function messages()
    {
        return [
            'goal_weight.required' => '目標の体重を入力してください',
            'goal_weight.numeric'  => '4桁までの数字で入力してください',
            'goal_weight.regex'    => '小数点は1桁で入力してください',
        ];
    }
}
