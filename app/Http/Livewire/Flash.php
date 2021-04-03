<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Flash extends Component
{

    public $message;
    public $type;

    public $colors = [
        'success' => 'border-green-700 text-green-700 bg-green-200',
        'error' => 'border-red-700 text-red-700 bg-red-200',
        'warning' => 'border-yellow-600 text-yellow-600 bg-yellow-200',
        'blue' => 'border-blue-700 text-blue-700 bg-blue-200',
    ];

    public $listeners =['flash' => 'setFlashMessage'];

    public function setFlashMessage($message, $type)
    {
        $this->message = $message;
        $this->type = $type;

        $this->dispatchBrowserEvent('flash-message');

    }

    public function render()
    {
        return view('livewire.flash');
    }
}
