<?php

namespace App\Controllers;

use App\Models\ActivityModel;
use App\Services\ActivityService;

class ActivitiesController extends BaseController
{
    protected ActivityModel $activityModel;

    public function __construct()
    {
        $this->activityModel = new ActivityModel();
    }

    public function index(): string
    {
        $typeFilter = $this->request->getGet('type');
        $query      = $this->activityModel;

        if ($typeFilter) {
            $query = $query->where('type', $typeFilter);
        }

        $activities = $query->orderBy('date', 'DESC')->findAll();

        return view('activities/index', [
            'title'      => 'Activities',
            'activities' => $activities,
            'typeFilter' => $typeFilter,
        ]);
    }

    public function create(): string
    {
        return view('activities/create', [
            'title'       => 'New Activity',
            'default_date' => date('Y-m-d\TH:i'),
        ]);
    }

    public function store()
    {
        $rules = [
            'type'        => 'required|in_list[call,email,meeting,note]',
            'description' => 'required|min_length[2]',
            'date'        => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $service = new ActivityService();
        $result  = $service->createActivity([
            'type'         => $this->request->getPost('type'),
            'description'  => $this->request->getPost('description'),
            'date'         => $this->request->getPost('date'),
            'related_type' => $this->request->getPost('related_type') ?: null,
            'related_id'   => $this->request->getPost('related_id') ?: null,
            'created_by'   => session()->get('user_id'),
        ]);

        if ($result === false) {
            return redirect()->back()->withInput()->with('error', 'Could not create activity.');
        }

        return redirect()->to('/activities')->with('success', 'Activity created successfully.');
    }

    public function edit(int $id): string
    {
        $activity = $this->activityModel->find($id);
        if (! $activity) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Activity not found.');
        }

        return view('activities/edit', ['title' => 'Edit Activity', 'activity' => $activity]);
    }

    public function update(int $id)
    {
        $activity = $this->activityModel->find($id);
        if (! $activity) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Activity not found.');
        }

        $rules = [
            'type'        => 'required|in_list[call,email,meeting,note]',
            'description' => 'required|min_length[2]',
            'date'        => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->activityModel->update($id, [
            'type'         => $this->request->getPost('type'),
            'description'  => $this->request->getPost('description'),
            'date'         => $this->request->getPost('date'),
            'related_type' => $this->request->getPost('related_type') ?: null,
            'related_id'   => $this->request->getPost('related_id') ?: null,
        ]);

        return redirect()->to('/activities')->with('success', 'Activity updated successfully.');
    }

    public function delete(int $id)
    {
        $activity = $this->activityModel->find($id);
        if (! $activity) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Activity not found.');
        }

        $this->activityModel->delete($id);

        return redirect()->to('/activities')->with('success', 'Activity deleted successfully.');
    }
}
