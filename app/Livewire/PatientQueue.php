<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Loket;
use App\Models\Antrian;
use Illuminate\Support\Facades\DB;

class PatientQueue extends Component
{
    public $loketId = '';
    public $patientName = '';
    public $nomor = '';
    public $success = false;
    public $error = '';
    public $lokets = [];

    public function mount()
    {
        $this->loadLokets();
    }

    protected function loadLokets()
    {
        // Get all lokets and convert to array after grouping to prevent collection methods issues
        $this->lokets = Loket::orderBy('type')
            ->orderBy('name')
            ->get()
            ->groupBy('type')
            ->map(function ($group) {
                return $group->values(); // Reset array keys
            })
            ->toArray();
    }

    public function getSelectedLoket()
    {
        if (!$this->loketId) {
            return null;
        }
        return Loket::find($this->loketId);
    }

    public function generate()
    {
        $this->error = '';
        $this->success = false;
        $this->nomor = '';

        try {
            $antrian = Antrian::generateForLoket($this->loketId, $this->patientName ?: null);
            $this->nomor = $antrian->nomor;
            $this->success = true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
    }

    // Convenience: select a loket and immediately generate a number (used by big buttons)
    public function generateWithLoket($loketId)
    {
        $this->loketId = $loketId;
        // clear patient name for button-driven flow
        $this->patientName = '';
        $this->generate();
    }

    public function render()
    {
        if (empty($this->lokets)) {
            $this->loadLokets();
        }
        return view('livewire.patient-queue', [
            'lokets' => $this->lokets,
            'error' => $this->error,
            'success' => $this->success,
            'nomor' => $this->nomor,
        ]);
    }
}
