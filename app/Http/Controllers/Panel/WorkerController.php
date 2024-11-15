<?php

namespace App\Http\Controllers\Panel;

use App\Models\Worker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller
{
    public function index()
    {
        $workers = Worker::where("user_id", auth()->guard("web")->user()->id)->get();
        return view("panel.workers", compact("workers"));
    }



    public function store(Request $request)
    {


        $data = Validator::make($request->all(), [
            "name" => "required",
            "phone" => ["required", "unique:workers,phone"],
            "password" => "required",
        ]);
        $workerData = $data->validate();

        $workerData["user_id"] = auth()->guard("web")->user()->id;
        $workerData['password'] = bcrypt($workerData['password']);
        $worker = Worker::create($workerData);
        return response()->json($worker);
    }
    public function update(Request $request,Worker $worker)
    {

        $data = Validator::make($request->all(), [
            "name" => "required",
            "phone" => ["required", "unique:workers,phone," . $worker->id],
            "password" => "nullable",
        ]);

        $workerData = $data->validate();
        if($workerData['password'] !== null){
            $workerData['password'] = bcrypt($workerData['password']);
        }else{
            unset($workerData['password']);
        }
        $worker->update($workerData);
        if ($worker) {
            return response()->json($worker);
        } else {
            return response()->json(['error' => 'Error updating worker'], 500);
        }
    }

    public function getWorker($id)
    {
        $worker = Worker::find($id);
        return response()->json($worker);
    }

    public function destroy(Worker $worker){
        if($worker->user_id !== auth()->guard("web")->user()->id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $worker->delete();
        return response()->json(['success' => 'Worker deleted successfully']);
    }
}
