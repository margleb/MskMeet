<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowEvent extends Component
{

    public $event, $toggleButton;

    public function render()
    {
        return view('livewire.show-event');
    }

    public function mount() {

        // иду на встречу, передумал
        $this->toggleButton = Auth::user()->events->contains($this->event);

    }

    // кол-во людей
    public function getPeopleProperty(): int
    {

        return count($this->event->users()->get());
    }

    // кол-во мужчин
    public function getMaleProperty(): int
    {

        return count($this->event->users()->where('gender', 'male')->get());
    }

    // кол-во женщин
    public function getFemaleProperty(): int
    {

        return count($this->event->users()->where('gender', 'female')->get());
    }


    /*
     * иду на встречу
     */
    public function toggle_meet() {

        $user = User::find(Auth::id());
        $user->events()->toggle($this->event->id);
        $this->toggleButton = !$this->toggleButton;

    }

}
