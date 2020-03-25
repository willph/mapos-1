<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $user = new User();

        return view('admin.users.create', compact('user'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = array_merge(
            $request->validated(),
            ['password' => Hash::make($request->get('password'))]
        );

        $user = new User($data);

        $user->save();

        return redirect(route('admin.users.index'))->with(['alert-success' => 'Usuário criado com sucesso!']);
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect(route('admin.users.index'))->with(['alert-success' => 'Usuário editado com sucesso!']);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return JsonResponse::create($user->toArray());
    }
}
