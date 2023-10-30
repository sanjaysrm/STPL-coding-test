<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhaseRequest;
use App\Http\Requests\UpdatePhaseRequest;
use App\Models\Phase;
use App\Models\Task;

class PhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhaseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Phase $phase)
    {
        return $phase->load('tasks.user')->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Phase $phase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhaseRequest $request, Phase $phase)
    {
        $phase->phase_id = $request->input('phase_id');
        $phase->save();
    }

      /**
     * Update the specified resource in storage.
     */
    public function phase_update(UpdatePhaseRequest $request, Phase $phase)
    {   
        $tasks = Task::whereIn('phase_id', $request->phaseCheck)->get();           
        $phase_id = $request->phase_id;  // Assign the phase_id to a variable
        
        $tasks->each(function ($task) use ($phase_id) { // Use the phase_id variable from the parent scope
            $task->update(['phase_id' => $phase_id]); // update phase_id here
        });     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phase $phase)
    {
        // delete tasks
        $phase->tasks()->delete();

        // delete phase
        $phase->delete();
    }
}
