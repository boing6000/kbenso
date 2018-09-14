<?php

namespace LaravelEnso\Core\app\Http\Controllers\Administration\Team;

use App\Http\Controllers\Controller;
use LaravelEnso\Core\app\Models\Team;
use LaravelEnso\Core\app\Http\Resources\Team as Resource;
use LaravelEnso\Core\app\Http\Requests\ValidateTeamRequest;

class TeamController extends Controller
{
    public function index()
    {
        return Resource::collection(
            Team::with('users')
                ->latest()
                ->get()
        );
    }

    public function store(ValidateTeamRequest $request)
    {
        $team = Team::store($request->validated());

        return [
            'message' => __('The team was successfully saved'),
            'team' => new Resource($team),
        ];
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return [
            'message' => __('The team was successfully deleted'),
        ];
    }
}
