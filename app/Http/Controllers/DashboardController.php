<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   // выводит все доступные мероприятия
   public function index() {

        return view('dashboard', ['events' => Event::all()]);
   }

}
