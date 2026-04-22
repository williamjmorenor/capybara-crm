<?php

namespace App\Controllers;

use App\Models\TagModel;

class TagsController extends BaseController
{
    protected TagModel $tagModel;

    public function __construct()
    {
        $this->tagModel = new TagModel();
    }

    public function index(): string
    {
        $tags = $this->tagModel->orderBy('name', 'ASC')->findAll();

        return view('tags/index', ['title' => 'Tags', 'tags' => $tags]);
    }

    public function create(): string
    {
        return view('tags/create', ['title' => 'New Tag']);
    }

    public function store()
    {
        $rules = [
            'name'  => 'required|min_length[1]|max_length[100]|is_unique[tags.name]',
            'color' => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->tagModel->insert([
            'name'  => $this->request->getPost('name'),
            'color' => $this->request->getPost('color') ?: '#6c757d',
        ]);

        return redirect()->to('/tags')->with('success', 'Tag created successfully.');
    }

    public function edit(int $id): string
    {
        $tag = $this->tagModel->find($id);
        if (! $tag) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Tag not found.');
        }

        return view('tags/edit', ['title' => 'Edit Tag', 'tag' => $tag]);
    }

    public function update(int $id)
    {
        $tag = $this->tagModel->find($id);
        if (! $tag) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Tag not found.');
        }

        $rules = [
            'name'  => 'required|min_length[1]|max_length[100]|is_unique[tags.name,id,' . $id . ']',
            'color' => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->tagModel->update($id, [
            'name'  => $this->request->getPost('name'),
            'color' => $this->request->getPost('color') ?: '#6c757d',
        ]);

        return redirect()->to('/tags')->with('success', 'Tag updated successfully.');
    }

    public function delete(int $id)
    {
        $tag = $this->tagModel->find($id);
        if (! $tag) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Tag not found.');
        }

        $this->tagModel->delete($id);

        return redirect()->to('/tags')->with('success', 'Tag deleted successfully.');
    }
}
