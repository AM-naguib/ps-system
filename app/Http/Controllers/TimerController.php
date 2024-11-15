<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class TimerController extends Controller
{
    public function index(){

        $devices = Device::where("user_id", auth()->guard("web")->user()->id ?? auth()->guard("worker")->user()->owner->id)->get();

        return view('timer.index', compact('devices'));
    }
}
