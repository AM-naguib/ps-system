<?php

namespace App\Http\Controllers\Panel;

use App\Models\Device;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::where("user_id", auth()->guard("web")->user()->id)->get();
        return view("panel.customers", compact("customers"));

    }



    public function store(Request $request)
    {


        $data = Validator::make($request->all(), [
            "name" => "required",
            "phone" => ["required", "unique:customers,phone"],
        ]);
        $customerData = $data->validate();

        $customerData["user_id"] = auth()->guard("web")->user()->id;
        $customer = Customer::create($customerData);
        return response()->json($customer);
    }


    public function update(Request $request,Customer $customer)
    {
        $data = Validator::make($request->all(), [
            "name" => "required",
            "phone" => ["required", "unique:customers,phone," . $customer->id],
        ]);

        $customerData = $data->validate();

        $customer->update($customerData);
        if ($customer) {
            return response()->json($customer);
        } else {
            return response()->json(['error' => 'Error updating customer'], 500);
        }
    }

    public function getCustomer($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }

    public function destroy(Customer $customer){
        if($customer->user_id !== auth()->guard("web")->user()->id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $customer->delete();
        return response()->json(['success' => 'Customer deleted successfully']);
    }
}
