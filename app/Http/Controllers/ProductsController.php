<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Products;
use Session;
class ProductsController extends Controller
{
    public function index(){

        //  $products= Products::get();

        $products= Products::orderby('id','desc')->paginate(5);
        return view('customer.product',compact('products'));
     }

     public function save(Request $request){
        $validatedData = $request->validate([
            
            'product' => ['required'],
            'price' => ['required'],  
        ]);
        $products=new Products;
        $products->product=$request->product;
        $products->price=$request->price;
        
       
            if($request->hasFile('image')){
                $validatedData = $request->validate([
            
                    'image' => 'required|mimes:jpeg,png,jpg,gif'
                    
                ]);
            $image=$request->file('image');
            $new_name=date('y-md-d').time().".".$image->extension();
            $path=public_path('/images');
            $image->move($path,$new_name);
            $products->image='images/'.$new_name;
            }
            $products->save();

        Session::flash("message","Products Records Added Successully");
        Session::flash("color","success");
        return back();
    }
    public function edit($id){

        $products= Products::find($id);
        return view('customer.edit_product',compact('products'));
    }
    public function update(Request $request){

        $products= Products::find($request->id);
        $products->product=$request->product;
        $products->price=$request->price;
       
        if($request->hasFile('image')){
            $validatedData = $request->validate([
        
                'image' => 'required|mimes:jpeg,png,jpg,gif'
                
            ]);
        $image=$request->file('image');
        $new_name=date('y-md-d').time().".".$image->extension();
        $path=public_path('/images');
        $image->move($path,$new_name);
        $products->image='images/'.$new_name;
        }
        $products->save();
        Session::flash("message","Products Records Updated Successully");
        Session::flash("color","success");
        return back();
    }
    public function delete($id){

        $products= Products::find($id);
        $products->delete();
        Session::flash("message","Customer Records deleted Successully");
        Session::flash("color","danger");
        return back();
    }

    public function view(){
        $products= Products::orderby('id','desc')->paginate(5);
        return view('home',compact('products'));
     }
    //  public function viewcms($id){
    //     $view_products= Products::find($id);
    //     return view('customer.product',compact('view_products'));
 
    //  }
    public function show($id)
    {
        $view_products = Products::find($id);
  
        return response()->json($view_products);
    }

    //single product
    public function single_index($id){
        // return view('customer.single-product');
        $products= Products::find($id);
        $lastFourRecords = Products::orderBy('id', 'desc')->take(4)->get();
        return view('customer.single-product',compact('products','lastFourRecords'));
        // return $products;
 
     }

    //  public function recent_product($id){
    //     $lastFourRecords = Products::orderBy('id', 'desc')->take(4)->get();
    //     return view('customer.single-product',compact('lastFourRecords'));
    //  }

}

