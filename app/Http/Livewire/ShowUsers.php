<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUsers extends Component
{

    use WithPagination;

    // кол-во пользователей на страницу
    public int $per = 20;

    // сортировка вывода на страницу
    public string $order = 'asc';

    // сортировка  по полу
    public string $gender = 'all';

    // дата
    public string $range = 'all';

    protected $queryString = ['per', 'gender', 'range'];

    public function updating()
    {
        // сбрасывать пагинацию при перезагрузки страницы
        $this->resetPage();
    }

    public function render()
    {

        $userQuery = User::query();

        // пол
        if($this->gender != 'all') {
            $userQuery->where('gender', $this->gender);
        }

        // возраст
        if($this->range != 'all') {

            $rangeAge = explode('-', $this->range);
            $rangeDates = [Carbon::now()->subYears($rangeAge[1]), Carbon::now()->subYears($rangeAge[0])];

            $userQuery->whereBetween('birthDate', [$rangeDates]);
        }

        return view('livewire.show-users', ['users' => $userQuery
            ->orderBy('created_at', $this->order)
            ->paginate($this->per)]);
    }

}
