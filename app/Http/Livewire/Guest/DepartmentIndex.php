<?php

namespace App\Http\Livewire\Guest;

use Livewire\Component;
use App\Models\Department;

class DepartmentIndex extends Component
{
    public function getDepartmentsProperty()
    {
        return Department::withCount('articles')->orderBy('name')->get();
    }
    
    public function render()
    {
        return view('livewire.guest.department-index')->layout('layouts.guest');
    }
}
