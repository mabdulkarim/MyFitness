<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Workout\StoreWorkoutRequest;
use App\Http\Requests\Workout\UpdateWorkoutRequest;
use App\Http\Resources\Workout\WorkoutResource;
use App\Http\Traits\HttpResponses;
use App\Models\Workout;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WorkoutController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return WorkoutResource::collection(Workout::with('exercises')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreWorkoutRequest $request
     * @return WorkoutResource|JsonResponse
     */
    public function store(StoreWorkoutRequest $request): WorkoutResource|JsonResponse
    {
        try {
            $workout = Workout::create($request->validated() + ['user_id' => auth()->id()]);

            $request->whenFilled('exercises', function (array $input) use ($workout) {
                $workout->exercises()->sync($input);
            });

            return new WorkoutResource($workout);
        } catch (QueryException $e) {
            return $this->error('One of the selected exercises could not be found.', 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Workout $workout
     * @return WorkoutResource
     */
    public function show(Workout $workout): WorkoutResource
    {
        return new WorkoutResource($workout);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorkoutRequest $request
     * @param Workout $workout
     * @return WorkoutResource|JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateWorkoutRequest $request, Workout $workout)
    {
        $this->authorize('update', $workout);

        try {
            $workout->update($request->validated());

            $request->whenFilled('exercises', function (array $input) use ($workout) {
                $workout->exercises()->attach($input);
            });

            return new WorkoutResource($workout);
        } catch (QueryException $e) {
            return $this->error('One of the selected exercises could not be found.', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Workout $workout
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Workout $workout): JsonResponse
    {
        $this->authorize('delete', $workout);

        $workout->delete();

        return $this->success('', 'Workout deleted successfully.');
    }
}
