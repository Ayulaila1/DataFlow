<?php

namespace App\Livewire\DataFlow;

use Livewire\Component;

class DataFlowComponent extends Component
{
    public function render()
    {
        return view('livewire.data-flow-component')
            ->layout('layouts.app');
    }
}