<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService {

    public function list($search)
    {
        return Department::withCount('articles')
            ->when($search, function ($query) use ($search) {
                return $query->where('name','LIKE', '%'.$search.'%');
            })
            ->orderBy('name')->paginate(10);
    }

    public function getAllDepartments()
    {
        return Department::latest()->get();
    }

    public function save($data)
    {
        return Department::updateOrCreate(
            ['id' => $data['id']],
            [
                'name' => $data['name']
            ],
        );
    }

    public function delete(Department $department)
    {
        $department->delete();
    }
}