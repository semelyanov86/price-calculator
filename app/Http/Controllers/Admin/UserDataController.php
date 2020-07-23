<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserDataRequest;
use App\Http\Requests\StoreUserDataRequest;
use App\Http\Requests\UpdateUserDataRequest;
use App\UserData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserDataController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDatas = UserData::all();

        return view('admin.userDatas.index', compact('userDatas'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.userDatas.create');
    }

    public function store(StoreUserDataRequest $request)
    {
        $userData = UserData::create($request->all());

        return redirect()->route('admin.user-datas.index');
    }

    public function edit(UserData $userData)
    {
        abort_if(Gate::denies('user_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.userDatas.edit', compact('userData'));
    }

    public function update(UpdateUserDataRequest $request, UserData $userData)
    {
        $userData->update($request->all());

        return redirect()->route('admin.user-datas.index');
    }

    public function show(UserData $userData)
    {
        abort_if(Gate::denies('user_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.userDatas.show', compact('userData'));
    }

    public function destroy(UserData $userData)
    {
        abort_if(Gate::denies('user_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userData->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserDataRequest $request)
    {
        UserData::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
