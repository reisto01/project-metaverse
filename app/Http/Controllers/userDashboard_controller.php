<?php

namespace App\Http\Controllers;


class userDashboard_controller extends Controller
{
    public function index()
    {
        return view('userpage.dashboard');
    }
}
