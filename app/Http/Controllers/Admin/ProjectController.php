<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Technology;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUserId = Auth::id();
        if($currentUserId == 1){
            $projects = Project::paginate(2);
        }else{
            $projects = Project::where('user_id', $currentUserId)->paginate(2);
        }
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        // $technologies = config('technologies.key');
        $technologies = Technology::all();
        return view('admin.projects.create', compact('technologies', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $formData = $request->validated();
        $slug = Str::slug($formData['title'], '-');
        $formData['slug'] = $slug;
        $userId = Auth::id();
        $formData['user_id'] = $userId;
        if ($request->hasFile('image')) {
            $path = Storage::put('uploads', $request->image);
            $formData['image'] = $path;
            // dd($path);
        }
        $project = Project::create($formData);
        if($request->has('technologies')){
            $project->technologies()->attach($request->technologies);
        }
        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $currentUserId = Auth::id();
        if($currentUserId == 1 || $project->user_id == $currentUserId){
            return view('admin.projects.show', compact('project'));
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $currentUserId = Auth::id();
        if($currentUserId != 1 && $currentUserId != $project->user_id){
            abort(403);
        }
        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin.projects.show', compact('project'));
        // $technologies = config('technologies.key');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $formData = $request->validated();
        if ($project->title !== $formData['title']) {
            $slug = Project::getSlug($formData['title']);
        }else{
            $slug = $project->slug;
        }
        // $slug = Str::slug($formData['title'], '-');
        $formData['slug'] = $slug;
        $formData['user_id'] = $project->user_id;
        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::delete($project->image);
            }
            $path = Storage::put('uploads', $request->image);
            $formData['image'] = $path;
        }
        $project->update($formData);
        if($request->has('technologies')){
            $project->technologies()->sync($request->technologies);
        }else{
            $project->technologies()->detach();
        }
        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $currentUserId = Auth::id();
        if($currentUserId != 1 && $currentUserId != $project->user_id){
            abort(403);
        }
            $project->delete();
            return to_route('admin.projects.index')->with('message', "Il Progetto '$project->title' è stato  eliminato");

    }
}
