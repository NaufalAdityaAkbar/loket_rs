<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Loket;

class MasterLoket extends Component
{
    public $name = '';
    public $type = '';
    public $mode = 'form'; // 'form' atau 'list'
    public $search = '';
    public $isFormOpen = false;
    public $editingLoketId = null;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:50',
        'type' => 'required|string|max:50',
    ];

    public function mount($mode = 'form')
    {
        $this->mode = $mode;
    }

    public function addLoket()
    {
        $this->validate();

        Loket::create([
            'name' => $this->name,
            'type' => $this->type,
        ]);

        $this->name = '';
        $this->type = '';
        $this->dispatch('loket-added');
    }

    public function deleteLoket($id)
    {
        $l = Loket::find($id);
        if ($l) $l->delete();
        $this->dispatch('loket-deleted');
    }

    public function editLoket($id)
    {
        $loket = Loket::find($id);
        if ($loket) {
            $this->editingLoketId = $id;
            $this->type = $loket->type;
            $this->name = $loket->name;
            $this->isEditing = true;
        }
    }

    public function updateLoket()
    {
        $this->validate();

        $loket = Loket::find($this->editingLoketId);
        if ($loket) {
            $loket->update([
                'name' => $this->name,
                'type' => $this->type
            ]);

            $this->resetForm();
            $this->dispatch('loket-updated');
        }
    }

    public function resetForm()
    {
        $this->editingLoketId = null;
        $this->type = '';
        $this->name = '';
        $this->isEditing = false;
    }

    public function render()
    {
        $query = Loket::query();
        
        if ($this->search) {
            $query->where(function($q) {
                $q->where('type', 'like', '%' . $this->search . '%')
                  ->orWhere('name', 'like', '%' . $this->search . '%');
            });
        }
        
        $lokets = $query->orderBy('id')->get();
        
        return view('livewire.master-loket', [
            'lokets' => $lokets,
        ]);
    }
}
