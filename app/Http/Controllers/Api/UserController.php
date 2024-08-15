<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return (new UserResource($user))
            ->additional(['message' => 'El usuario ha sido creado con éxito'])
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return (new UserResource($user))
            ->additional(['message' => 'El usuario ha sido actualizado con éxito']);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'El usuario ha sido eliminado con éxito'
        ], 200);
    }
}
