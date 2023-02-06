<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Workout\StoreWorkoutRequest;
use App\Http\Requests\Workout\UpdateWorkoutRequest;
use App\Http\Resources\Workout\WorkoutResource;
use App\Http\Traits\HttpResponses;
use App\Models\Workout;
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
    public function index()
    {
        return WorkoutResource::collection(Workout::with('exercises')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreWorkoutRequest $request
     * @return WorkoutResource|JsonResponse
     */
    public function store(StoreWorkoutRequest $request)
    {
        try {
            $workout = Workout::create($request->validated());
            auth()->user()->workouts()->attach($workout);

            if ($request->exists('exercises')){
                $workout->exercises()->attach($request->input('exercises'));
            }

            return new WorkoutResource($workout);
        } catch(QueryException $e) {
            return $this->error('The specified resource could not be found.', 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Workout $workout
     * @return WorkoutResource
     */
    public function show(Workout $workout)
    {
        return new WorkoutResource($workout);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateWorkoutRequest  $request
     * @param  Workout $workout
     * @return WorkoutResource
     */
    public function update(UpdateWorkoutRequest $request, Workout $workout)
    {
        $this->authorize('update', $workout);

        $workout->update($request->validated());

        return new WorkoutResource($workout);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Workout $workout
     * @return JsonResponse
     */
    public function destroy(Workout $workout)
    {
        $this->authorize('delete', $workout);

        $exercices = $workout->exercises()->get();
        $workout->exercises()->detach($exercices);

        $users = $workout->users()->get();
        $workout->users()->detach($users);

        $workout->delete();

        return $this->success('', 'Workout deleted successfully.');
    }
}
