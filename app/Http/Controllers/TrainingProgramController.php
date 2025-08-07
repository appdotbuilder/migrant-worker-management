<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainingProgramRequest;
use App\Http\Requests\UpdateTrainingProgramRequest;
use App\Models\TrainingProgram;
use Inertia\Inertia;

class TrainingProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = TrainingProgram::latest()
            ->paginate(10)
            ->withQueryString();
        
        return Inertia::render('training-programs/index', [
            'programs' => $programs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('training-programs/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingProgramRequest $request)
    {
        $program = TrainingProgram::create($request->validated());

        return redirect()->route('training-programs.show', $program)
            ->with('success', 'Program pelatihan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingProgram $trainingProgram)
    {
        $trainingProgram->load(['memberTrainings.member']);
        
        return Inertia::render('training-programs/show', [
            'program' => $trainingProgram
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingProgram $trainingProgram)
    {
        return Inertia::render('training-programs/edit', [
            'program' => $trainingProgram
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingProgramRequest $request, TrainingProgram $trainingProgram)
    {
        $trainingProgram->update($request->validated());

        return redirect()->route('training-programs.show', $trainingProgram)
            ->with('success', 'Program pelatihan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingProgram $trainingProgram)
    {
        $trainingProgram->delete();

        return redirect()->route('training-programs.index')
            ->with('success', 'Program pelatihan berhasil dihapus.');
    }
}