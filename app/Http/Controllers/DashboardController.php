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

   // подтверждаем готовность отправки на мероприятие
   public function submitEvent(Request $request) {



       $userId = Auth::user()->id;
       $user = User::find($userId);
       $eventId = (int) $request->event_id;

       $user->events()->toggle($eventId);

       return redirect()->back();

   }
}
