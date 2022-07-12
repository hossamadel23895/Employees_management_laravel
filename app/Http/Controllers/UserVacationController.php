<?php

namespace App\Http\Controllers;

use App\Http\Resources\VacationResource;
use App\Models\User;
use App\Models\Vacation;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserVacationController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user) {
        $vacations = $user->vacations()->get();
        return VacationResource::collection($vacations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user) {
        $reqData = $request->only('start_date', 'end_date', 'reason', 'type_id');
        $vacation = $user->vacations()->create($reqData);

        return VacationResource::make($vacation)->additional([
            'message' =>  'Vacation Created successfully'
        ])->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Vacation $vacation) {
        return VacationResource::make($vacation)->additional([
            'message' =>  'Vacation Showed successfully'
        ])->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Vacation $vacation) {
        $reqData = $request->only('start_date', 'end_date', 'reason', 'type_id');

        $vacation->update($reqData);

        return VacationResource::make($vacation)->additional([
            'message' =>  'Vacation Updated successfully'
        ])->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Vacation $vacation) {
        $vacation->user()->dissociate();
        $vacation->type()->dissociate();
        $vacation->delete();

        return response([
            'message'  => 'Vacation deleted successfully',
        ], Response::HTTP_OK);
    }
}
