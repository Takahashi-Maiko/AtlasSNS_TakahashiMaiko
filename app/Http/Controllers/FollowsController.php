<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    public function followList(){   //フォローリスト
        return view('follows.followList');
    }
    public function followerList(){   //フォロワーリスト
        return view('follows.followerList');
    }
}
