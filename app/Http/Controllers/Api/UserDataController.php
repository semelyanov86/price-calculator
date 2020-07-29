<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserDataApiRequest;
use App\Http\Resources\UserDataResource;
use App\UserData;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    public function store(StoreUserDataApiRequest $request)
    {
        $data = $request->validated();
        unset($data['type']);
        $data = json_encode($data);
        $userDataModel = new UserData();
        $userDataModel->type = $request->get('type');
        $userDataModel->data = $data;
        $userDataModel->save();
        return new UserDataResource($userDataModel);
    }
}
