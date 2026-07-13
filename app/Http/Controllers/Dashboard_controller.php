<?php

namespace App\Http\Controllers;

use App\Models\maps_metaverse;
use App\Models\prop_metaverse;
use App\Models\tb_mail;
use App\Models\User;
use App\Models\user_roles;
use Illuminate\Support\Carbon;

class Dashboard_controller extends Controller
{
   public function index()
   {
      $data['roles'] = user_roles::get();
      $data['Page'] = "Dashboard";
      $data['total_user'] = User::where('is_deleted',1)->count();
      $data['total_land'] = maps_metaverse::where('is_deleted',1)->count();
      $data['total_prop'] = prop_metaverse::where('is_deleted',1)->count();
      $data['total_contact'] = tb_mail::where('is_deleted',1)->count();


      $today = Carbon::today();
      $tomorrow = $today->copy()->addDay();
      $data['user_add_today'] = User::where('is_deleted', 1)->where('created_at', '>=', $today)->where('created_at', '<', $tomorrow)->count();
      $data['land_add_today'] = maps_metaverse::where('is_deleted', 1)->where('created_at', '>=', $today)->where('created_at', '<', $tomorrow)->count();
      $data['prop_add_today'] = prop_metaverse::where('is_deleted', 1)->where('created_at', '>=', $today)->where('created_at', '<', $tomorrow)->count();
      $data['contact_add_today'] = tb_mail::where('is_deleted', 1)->where('created_at', '>=', $today)->where('created_at', '<', $tomorrow)->count();


    return view('adminpage.dashboard',$data);
   }
}

