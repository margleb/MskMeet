<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Event;
use App\Models\Location;
use App\Models\User;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

       $response = new Response();


        // 1. Для каждой локации по два события
        Location::factory(4)
            ->state(new Sequence(
                ['address' => 'ВДНХ'],
                ['address' => 'Красная площадь'],
                ['address' => 'Парк Горького'],
                ['address' => 'Парк Зарядье'],
            ))
            ->has(Event::factory(2))
            ->create();


        // 2. Создаем 10 рандомных пользователей
        for($i = 0; $i < 10; $i++) {

            // 1. Получаем данные с сервиса https://randomuser.me/
            $response = Http::RandomUser()->get('api/');

            if($response->successful()) {

                    $userData = array_shift($response->json()['results']);

                    // заполняем ими таблицу
                    $user = User::create([
                        'name' => $userData['name']['first'] . ' ' . $userData['name']['last'],
                        'email' => $userData['email'],
                        'sex' => $userData['gender'],
                        'email_verified_at' => now(),
                        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                        'phone' => $userData['phone'],
                        'secretKey' => Str::random(5),
                        'birthDate' => fake()->dateTimeInInterval(),
                        'remember_token' => Str::random(10),
                    ]);

                    // добавляем аватарку
                    $user->addMediaFromUrl($userData['picture']['large'])->toMediaCollection('avatars');
            }
        }


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
