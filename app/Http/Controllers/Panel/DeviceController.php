<?php

namespace App\Http\Controllers\Panel;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::where("user_id", auth()->guard("web")->user()->id)->get();
        return view("panel.devices", compact("devices"));

    }



    public function store(Request $request)
    {


        $data = Validator::make($request->all(), [
            "name" => "required",
        ]);
        $deviceData = $data->validate();

        $deviceData["user_id"] = auth()->guard("web")->user()->id;
        $device = Device::create($deviceData);
        return response()->json($device);
    }


    public function update(Request $request,Device $device)
    {
        $data = Validator::make($request->all(), [
            "name" => "required",
        ]);

        $deviceData = $data->validate();

        $device->update($deviceData);
        if ($device) {
            return response()->json($device);
        } else {
            return response()->json(['error' => 'Error updating device'], 500);
        }
    }

    public function getDevice($id)
    {
        $device = Device::find($id);
        return response()->json($device);
    }

    public function destroy(Device $device){
        if($device->user_id !== auth()->guard("web")->user()->id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $device->delete();
        return response()->json(['success' => 'Device deleted successfully']);
    }
}
