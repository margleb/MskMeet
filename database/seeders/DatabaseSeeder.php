<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Event;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // 2. Для каждой локации по два события
        Location::factory(4)
            ->state(new Sequence(
                ['address' => 'ВДНХ'],
                ['address' => 'Красная площадь'],
                ['address' => 'Парк Горького'],
                ['address' => 'Парк Зарядье'],
            ))
            ->has(Event::factory(2))
            ->create();

        // 2. Создаем 6 пользователей
        User::factory(6)
            //  3 - мужчины / 3 - женщины
            ->state(new Sequence(
                ['sex' => 'male'],
                ['sex' => 'female']
            ))
            ->create();

        // соединяем рандомно пользователей и события
        foreach(User::all() as $user) {
            DB::table('event_user')->insert(
                [
                    'event_id' => Event::select('id')->orderByRaw("RAND()")->first()->id,
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
