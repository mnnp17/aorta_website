<?php

namespace App\Contracts\Repositories;
use App\Contracts\Interfaces\ProjectInterface;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Services\ProjectService;

class ProjectRepository extends BaseRepository implements ProjectInterface
{
    public ProjectService $projectService;

    public function __construct(Project $project, ProjectService $projectService)
    {
        $this->model = $project;
        $this->projectService = $projectService;
    }

    public function get()
    {
        return $this->model->query()->get();
    }

    public function store(array $data)
    {
        $project = $this->show($data['id']);
        if (isset($data['image'])) {
            $project->image = $data['image']->store('projects');
        }
        return $this->model->query()->create($data);
    }

    public function update(string $id, array $data)
    {
        $project = $this->show($data['id']);
        if (isset($data['image'])) {
            if (isset($project->image) && Storage::exists($project->image)) {
                Storage::delete($project->image);
            }
            $project->image = $data['image']->store('projects');
        }
        return $this->model->query()->findOrFail($id)->update($data);
    }

    public function show(string $id)
    {
        return $this->model->query()->findOrFail($id);
    }

    public function delete(string $id)
    {
        if (isset($this->show($id)->image) && Storage::exists($this->show($id)->image)) {
            Storage::delete($this->show($id)->image);
        }
        return $this->model->query()->findOrFail($id)->delete();
    }
}
