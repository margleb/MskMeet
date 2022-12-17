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
    public int $perPage = 20;

    // сортировка вывода на страницу
    public string $orderBy = 'asc';

    // сортировка  по полу
    public string $gender = 'all';

    // дата
    public string $rangeAge = 'all';

    protected $queryString = ['perPage', 'gender', 'rangeAge'];

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
        if($this->rangeAge != 'all') {

            $rangeAge = explode('-', $this->rangeAge);
            $rangeDates = [Carbon::now()->subYears($rangeAge[1]), Carbon::now()->subYears($rangeAge[0])];

            $userQuery->whereBetween('birthDate', [$rangeDates]);
        }

        return view('livewire.show-users', ['users' => $userQuery
            ->orderBy('created_at', $this->orderBy)
            ->paginate($this->perPage)]);
    }

}
