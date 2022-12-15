<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Event;
use App\Models\Location;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
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

        // Создаем локации
        Artisan::call('command:generateLocations 50 monuments_and_memorials,miniature_parks');

        // Для каждой локации одно собитие
        foreach(Location::all() as $location) {
            Event::create([
               'address' => 'longitude: ' . $location->longitude.' latitude: '.$location->latitude,
               'start_event' => Carbon::today()->addDays(rand(0, 179))->addSeconds(rand(0, 86400)),
               'location_id' => $location->id,
               'created_at' => now(),
               'updated_at' => now()
            ]);
        }

        // создаем пользователей
        Artisan::call('command:generateUsers 80');

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
