<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GenerateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:generateUsers {max?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // 2. Создаем 10 рандомных пользователей
        for($i = 0; $i < $this->argument('max'); $i++) {

            // 1. Получаем данные с сервиса https://randomuser.me/
            $response = Http::RandomUser()->get('api/');

            if($response->successful()) {

                $userData = array_shift($response->json()['results']);

                // заполняем ими таблицу
                $user = User::create([
                    'name' => $userData['name']['first'] . ' ' . $userData['name']['last'],
                    'email' => $userData['email'],
                    'gender' => $userData['gender'],
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

        return Command::SUCCESS;
    }
}
