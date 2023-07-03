<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;

use Session;

class CustomerController extends Controller
{
    public function index(){
       //for all data
       // $customers= Customer::get();
        //or pagination
        $customers= Customer::orderby('id','desc')->paginate(5);
         return view('customer.index',compact('customers'));

    }
    public function save(Request $request){
        $validatedData = $request->validate([
            
            'name' => ['required'],
            'password' => ['required'],
            'phone_no' => ['required'],
            
        ]);
        $customer=new Customer;
        $customer->name=$request->name;
        $customer->password=$request->password;
        $customer->phone_no=$request->phone_no;
        // $customer->image=$request->image;
        
            if($request->hasFile('image')){
                $validatedData = $request->validate([
            
                    'image' => 'required|mimes:jpeg,png,jpg,gif'
                    
                ]);
            $image=$request->file('image');
            $new_name=date('y-md-d').time().".".$image->extension();
            $path=public_path('/images');
            $image->move($path,$new_name);
            $customer->image='images/'.$new_name;
            }
            $customer->save();
        // $customer=Customer::create([
        //     'name'=>$request->name,
        //     'password'=>$request->password,
        //     'phone_no'=>$request->phone_no,
        //     'images'=>'/image/'.$new_name,
        // ]);
        Session::flash("message","Customer Records Added Successully");
        Session::flash("color","success");
        return back();
    }

    public function edit($id){

        $customer= Customer::find($id);
        return view('customer.customer_edit',compact('customer'));
    }
    public function update(Request $request){

        $customer= Customer::find($request->id);
        $customer->name=$request->name;
        $customer->password=$request->password;
        $customer->phone_no=$request->phone_no;
        $customer->image=$request->image;
        $customer->save();
        Session::flash("message","Customer Records Updated Successully");
        Session::flash("color","success");
        return back();
    }
    public function delete($id){

        $customer= Customer::find($id);
        $customer->delete();
        Session::flash("message","Customer Records deleted Successully");
        Session::flash("color","danger");
        return back();
    }
}
