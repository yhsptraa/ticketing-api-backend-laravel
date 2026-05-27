<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function bookingHistory()
    {
        $user = Auth::user();
        $bookings = $user->bookings()->with('schedule.movie')->latest()->get();
        return view('user.history', compact('bookings'));
    }
}
