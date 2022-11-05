<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository){
        $this->repository = $repository;
    }

    public function index()
    {
        $users = User::query()->get();
        return UserResource::collection($users);
    }


    public function store(StoreUserRequest $request)
    {
        $created = $this->repository->create($request->only([
            'name','email','password'
        ]));
        return new UserResource($created);
    }

    
    public function show(User $user)
    {
        return new UserResource($user);
    }

   

   
    public function update(UpdateUserRequest $request, User $user)
    {
        $updated = $this->repository->update($user,$request->only([
            'name','email'
        ]));

        return new UserResource($updated);
    }

    
    public function destroy(User $user)
    {
        $deleted = $this->repository->forceDelete($user);

        return new JsonResponse($deleted);
    }
}
