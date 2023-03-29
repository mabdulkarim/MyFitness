<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Workout\ExerciseRequest;
use App\Http\Resources\Workout\ExerciseResource;
use App\Http\Traits\HttpResponses;
use App\Models\Exercise;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExerciseController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ExerciseResource::collection(Exercise::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ExerciseRequest $request
     * @return ExerciseResource
     */
    public function store(ExerciseRequest $request): ExerciseResource
    {
        $exercise = Exercise::create($request->validated() + ['user_id' => auth()->id()]);

        return new ExerciseResource($exercise);
    }

    /**
     * Display the specified resource.
     *
     * @param  Exercise $exercise
     * @return ExerciseResource
     */
    public function show(Exercise $exercise): ExerciseResource
    {
        return new ExerciseResource($exercise);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ExerciseRequest $request
     * @param  Exercise $exercise
     * @return ExerciseResource
     */
    public function update(ExerciseRequest $request, Exercise $exercise): ExerciseResource
    {
        $this->authorize('update', $exercise);

        $exercise->update($request->validated());

        return new ExerciseResource($exercise);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Exercise $exercise
     * @return JsonResponse
     */
    public function destroy(Exercise $exercise)
    {
        $this->authorize('delete', $exercise);

        $exercise->delete();

        return $this->success(null, 'Exercise deleted successfully.');
    }

}
