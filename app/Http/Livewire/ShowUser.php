<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class ShowUser extends Component
{

    public User $user;

    public function render()
    {
        return view('livewire.show-user');
    }

    public function getAgeProperty() {
        $date = Carbon::parse($this->user->birthDate);
        return Carbon::now()->diffInYears($date);
    }
}
