<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ShowUsers extends Component
{

    // кол-во пользователей на страницу
    public int $perPage = 20;

    // сортировка вывода на страницу
    public string $orderBy = 'asc';

    // сортировка  по полу
    public string $gender = 'all';

    // возраст
    public string $age = 'all';


    public function render()
    {


        $userQuery = User::query();

        if($this->gender != 'all') {
            $userQuery->where('gender', $this->gender);
        }

        if($this->age != 'all') {

        }

        return view('livewire.show-users', ['users' => $userQuery
            ->orderBy('created_at', $this->orderBy)
            ->paginate($this->perPage)]);
    }

}
