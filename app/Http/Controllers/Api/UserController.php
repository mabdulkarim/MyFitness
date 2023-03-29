<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\HttpResponses;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        return UserResource::collection(User::with('userMeasurements')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return JsonResponse|UserResource
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  User $user
     * @return UserResource|JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update($request->safe()->only(['name','age', 'gender', 'height', 'email', 'password']));

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return $this->success('', 'User deleted successfully!');
    }

}
