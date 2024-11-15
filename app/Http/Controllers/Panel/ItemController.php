<?php

namespace App\Http\Controllers\Panel;


use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::where("user_id", auth()->guard("web")->user()->id)->get();
        return view("panel.items", compact("items"));

    }



    public function store(Request $request)
    {


        $data = Validator::make($request->all(), [
            "name" => "required",
            "price" => "required|integer",
        ]);
        $itemData = $data->validate();

        $itemData["user_id"] = auth()->guard("web")->user()->id;
        $item = Item::create($itemData);
        return response()->json($item);
    }


    public function update(Request $request,Item $item)
    {
        $data = Validator::make($request->all(), [
            "name" => "required",
            "price" => "required|integer",
        ]);

        $itemData = $data->validate();

        $item->update($itemData);
        if ($item) {
            return response()->json($item);
        } else {
            return response()->json(['error' => 'Error updating item'], 500);
        }
    }

    public function getItem($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }


    public function destroy(Item $item){
        if($item->user_id !== auth()->guard("web")->user()->id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $item->delete();
        return response()->json(['success' => 'Item deleted successfully']);
    }
}
