<?php

namespace App\Http\Controllers\Panel;

use App\Models\Worker;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class SettingController extends Controller
{
    public function index()
    {

        $settings = null;
        if (auth()->guard("web")->user()) {
            $settings = Setting::where("user_id", auth()->guard("web")->user()->id)->first();
        }

        return view("panel.settings", compact("settings"));
    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            "name" => "required",
            "phone" => "required",
            "password" => "nullable",
            "single_price" => "nullable|integer",
            "multi_price" => "nullable|integer"
        ]);

        $settingData = $data->validate();

        if (auth()->guard("web")->user()) {
            $user = auth()->guard("web")->user();

            $settingData['password'] = $settingData['password']
                ? bcrypt($settingData['password'])
                : $user->password;

            $user->update([
                "name" => $settingData['name'],
                "phone" => $settingData['phone'],
                "password" => $settingData['password'],
            ]);

            Setting::updateOrCreate(
                ["user_id" => $user->id],
                [
                    "single_price" => $settingData['single_price'],
                    "multi_price" => $settingData['multi_price'],
                ]
            );


        }

        if (auth()->guard("worker")->user()) {
            $worker = Worker::find(auth()->guard("worker")->user()->id);
            $settingData['password'] = $settingData['password']
                ? bcrypt($settingData['password'])
                : $worker->password;
            $worker->update([
                "name" => $settingData['name'],
                "phone" => $settingData['phone'],
                "password" => $settingData['password'],
            ]);

        }
        return to_route("panel.settings.index")->with("success", "تم حفظ الاعدادات بنجاح");


    }
}
