<?php

namespace App\Http\Requests;

use App\UserData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreUserDataRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [];
    }
}
