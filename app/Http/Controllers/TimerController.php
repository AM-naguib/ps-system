<?php

namespace App\Http\Controllers;

use App\Models\TimerLog;
use Carbon\Carbon;
use App\Models\Device;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimerController extends Controller
{
    public function index()
    {
        $devices = Device::where("user_id", auth()->guard("web")->user()->id ?? auth()->guard("worker")->user()->owner->id)->get();

        return view('timer.index', compact('devices'));
    }


    public function startTime($id)
    {
        $device = Device::find($id);
        if (!$device) {
            return response()->json(['error' => 'Device not found'], 404);
        }

        if (auth()->guard("web")->check()) {
            $user = auth()->guard("web")->user();


            if ($user->id !== $device->user_id) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }


        } else {
            $user = auth()->guard("worker")->user();
            if ($user->owner->id !== $device->user_id) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

        }
        if ($device->status === 'مشغول') {
            return response()->json(['error' => 'Device is already running'], 400);
        }

        $device->status = 'مشغول';
        $device->save();
        $this->storeStartTime($device->id, $device->user_id);
        return response()->json(['success' => 'Device started successfully']);
    }




    public function stopTime($id)
    {
        $device = Device::find($id);
        if (!$device) {
            return response()->json(['error' => 'Device not found'], 404);
        }

        if (auth()->guard("web")->check()) {
            $user = auth()->guard("web")->user();


            if ($user->id !== $device->user_id) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            $user = auth()->guard("worker")->user();
            if ($user->owner->id !== $device->user_id) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }

        if ($device->status === 'متاح') {
            return response()->json(['error' => 'Device is already stopped'], 400);
        }

        $device->status = 'متاح';
        $device->save();
        $this->storeEndTime($device->id, $device->user_id);
        return response()->json(['success' => 'Device stopped successfully']);
    }



    public function storeStartTime($device_id, $user_id)
    {
        $timer = TimerLog::create([
            "user_id" => $user_id,
            "device_id" => $device_id,
            "start_time" => Carbon::now(),
            "status" => "started"
        ]);
        return $timer;
    }

    public function storeEndTime($device_id, $user_id)
    {

        $timer = TimerLog::where("device_id", $device_id)->where("user_id", $user_id)->where("status", "started")->first();
        $timer->end_time = Carbon::now();
        $timer->duration = $timer->end_time->diffInSeconds($timer->start_time) / 60;
        $timer->status = "ended";
        $timer->save();
        return $timer;
    }
}
