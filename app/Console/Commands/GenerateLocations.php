<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GenerateLocations extends Command
{
    /**
     * The name and signature of the console command.
     * options - https://opentripmap.io/catalog
     * monuments_and_memorials,churches
     * @var string
     */
    protected $signature = 'command:generateLocations {max?} {kinds?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    const API_KEY = '5ae2e3f221c38a28845f05b6c84b6343143f45079509117ea42ff1e8';
    const MOSCOW_LOCATION = ['lon_min' => '37.376550', 'lat_min' => '55.571047', 'lon_max' => '37.850237', 'lat_max' => '55.907501'];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $filteredMskMeet = [];
        $ext = ['.jpg', '.JPG', '.png'];

        $url = '0.1/ru/places/bbox?'.
            'lon_min='.self::MOSCOW_LOCATION['lon_min'].
            '&lat_min='.self::MOSCOW_LOCATION['lat_min'].
            '&lon_max='.self::MOSCOW_LOCATION['lon_max'].
            '&lat_max='.self::MOSCOW_LOCATION['lat_max'];
            if(!empty($this->arguments())) {
                $url .= "&kinds=" . implode(',', $this->argument('kinds'));
            }
            $url .= '&apikey='. self::API_KEY;

        $moscowPlaces = Http::OpenTripMap()->get($url)->json()['features'];


        foreach($moscowPlaces as $key => $mskPlace) {

            $placeCoordinates = $mskPlace['geometry']['coordinates'];
            $xid = $mskPlace['properties']['xid'];
            $placeName = $mskPlace['properties']['name'];

            $image = Http::OpenTripMap()->get("0.1/ru/places/xid/$xid?apikey=".self::API_KEY)->json()['preview']['source'];
            $separator = '.jpg';
            foreach($ext as $item) {
                if (str_contains($image, $item)) {
                    $separator = $item;
                }
            }

            $formatImage = explode($separator, str_replace('thumb/', '', $image))[0] . $separator;

            $filteredMskMeet[] = [
                'title' => $placeName, // название места
                'longitude' => $placeCoordinates[0],
                'latitude' => $placeCoordinates[1],
                'address' => '123', //
                'image' => $formatImage, // изображение
                'created_at' => now(),
                'updated_at' => now()
            ];

            if($key == $this->argument('max')) break;

        }

        // добавляем записи в таблицу
        DB::table('locations')->insert($filteredMskMeet);


        return Command::SUCCESS;
    }
}
