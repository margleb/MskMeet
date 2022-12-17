<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ShowUsers extends Component
{

    public $perPage = 20;

    public function render()
    {
        return view('livewire.show-users', ['users' => User::paginate($this->perPage)]);
    }

}
