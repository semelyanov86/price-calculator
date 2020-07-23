<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserDataRequest;
use App\Http\Requests\UpdateUserDataRequest;
use App\Http\Resources\Admin\UserDataResource;
use App\UserData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserDataApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserDataResource(UserData::all());
    }

    public function store(StoreUserDataRequest $request)
    {
        $userData = UserData::create($request->all());

        return (new UserDataResource($userData))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserData $userData)
    {
        abort_if(Gate::denies('user_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserDataResource($userData);
    }

    public function update(UpdateUserDataRequest $request, UserData $userData)
    {
        $userData->update($request->all());

        return (new UserDataResource($userData))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserData $userData)
    {
        abort_if(Gate::denies('user_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userData->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
