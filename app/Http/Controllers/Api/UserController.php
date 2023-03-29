<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserMeasurementRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserMeasurementResource;
use App\Http\Resources\UserResource;
use App\Http\Traits\HttpResponses;
use App\Models\User;
use App\Models\UserMeasurement;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        
        return UserResource::collection(User::with('userMeasurements')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse|UserResource
     * @throws AuthorizationException
     */
    public function show(User $user): UserResource|JsonResponse
    {
        $this->authorize('view', $user);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return UserResource|JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateUserRequest $request, User $user): UserResource|JsonResponse
    {
        $this->authorize('update', $user);

        $user->update($request->safe()->only(['name','age', 'gender', 'height', 'email', 'password']));

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', $user);

        $user->delete();

        return $this->success('', 'User deleted successfully!');
    }

    /**
     * Create a user measurement for the user model
     *
     * @param StoreUserMeasurementRequest $request
     * @param User $user
     * @return UserMeasurementResource
     * @throws AuthorizationException
     */
    public function createUserMeasurement(StoreUserMeasurementRequest $request, User $user): UserMeasurementResource
    {
        $this->authorize('createUserMeasurement', $user);

        $userMeasurement = UserMeasurement::create($request->validated() + ['user_id' => auth()->id()]);

        return new UserMeasurementResource(($userMeasurement));
    }

}
