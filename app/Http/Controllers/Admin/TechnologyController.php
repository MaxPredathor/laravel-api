<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $formData = $request->validated();
        $formData['slug'] = Str::slug($formData['name'], '-');
        if($formData['name'] === 'laravel') {
            $formData['image'] = 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/'. $formData['name'] . '/' . $formData['name'] . '-plain.svg';
        }else{
            $formData['image'] = 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/'. $formData['name'] . '/' . $formData['name'] . '-original.svg';
        }
        $technology = Technology::create($formData);
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $formData = $request->validated();
        // $formData['slug'] = $technology->slug

        if($technology->name !== $formData['name']) {
            $formData['slug'] = Str::slug($formData['name'], '-');
        }else{
            $formData['slug'] = $technology->slug;
        }
        $technology->update($formData);
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')->with('message', "La Technology '$technology->name' è stata  eliminata");
    }
}
