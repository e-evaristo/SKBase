<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use App\Services\DepartmentService;

class Departments extends Component
{
    use WithPagination;
    use \WireUi\Traits\Actions;

    public $search, $cardModal, $name, $department_id;

    protected $rules = [
        'name' => 'required|string|max:100',
    ];

    protected $validationAttributes  = [
        'name' => 'Name'
    ];

    public function getDepartmentsProperty(DepartmentService $service)
    {
        return $service->list($this->search);
    }

    public function resetFilter()
    {
        $this->search = null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->clearValidation();
        $this->reset(['name','department_id']);
        $this->cardModal = true;
    }

    public function edit(Department $obj)
    {
        $this->department_id = $obj->id;
        $this->name = $obj->name;
        $this->cardModal = true;
    }

    public function save(DepartmentService $service) 
    {
        $this->validate();
        $service->save([
            'id' => $this->department_id,
            'name' => $this->name
        ]);
        
        $this->notification()->notify([
            'title'   => ($this->department_id ? 'Department Updated Successfully.' : 'Department Created Successfully.'),
            'icon'    => 'success',
            'timeout' => 2000,
            'dense'   => true
        ]);
        $this->cardModal = false;
    }

    public function delete(DepartmentService $service, Department $department_id)
    {
        $service->delete($department_id);
        $this->cardModal = false;
        $this->notification()->notify([
            'title'   => 'Department deleted Successfully.',
            'icon'    => 'success',
            'timeout' => 2000,
        ]);
    }
    
    public function render()
    {
        return view('livewire.admin.departments');
    }
}
