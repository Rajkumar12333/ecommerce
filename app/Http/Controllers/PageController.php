<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pages;

use Session;

class PageController extends Controller
{
    public function index(){
        //for all data
        // $customers= Customer::get();
         //or pagination
         $pages= Pages::orderby('id','desc')->paginate(5);
          return view('customer.pages',compact('pages'));
 
     }
     public function save(Request $request){
         $validatedData = $request->validate([
             
             'title' => ['required'],
             'editor' => ['required'],
          
             
         ]);
         $pages=new Pages;
         $pages->title=$request->title;
        //  $pages->editor=$request->editor;
        $pages->editor = $validatedData['editor'];
         
         
             if($request->hasFile('image')){
                 $validatedData = $request->validate([
             
                     'image' => 'required|mimes:jpeg,png,jpg,gif'
                     
                 ]);
             $image=$request->file('image');
             $new_name=date('y-md-d').time().".".$image->extension();
             $path=public_path('/images');
             $image->move($path,$new_name);
             $pages->image='images/'.$new_name;
             }
             $pages->save();

         Session::flash("message","New pages Added Successully");
         Session::flash("color","success");
         return back();
     }
 
     public function edit($id){
 
         $pages= Pages::find($id);
         return view('customer.edit_page',compact('pages'));
     }
     public function update(Request $request){

        $pages= Pages::find($request->id);
        $pages->title=$request->title;
        $pages->editor=$request->editor;
       
        if($request->hasFile('image')){
            $validatedData = $request->validate([
        
                'image' => 'required|mimes:jpeg,png,jpg,gif'
                
            ]);
        $image=$request->file('image');
        $new_name=date('y-md-d').time().".".$image->extension();
        $path=public_path('/images');
        $image->move($path,$new_name);
        $pages->image='images/'.$new_name;
        }
        $pages->save();
        Session::flash("message","Products Records Updated Successully");
        Session::flash("color","success");
        return back();
    }
    public function aboutus(){
 
        $pages= Pages::find(1);
        return view('page_view',compact('pages'));
    }
     public function delete($id){
 
         $customer= Pages::find($id);
         $customer->delete();
         Session::flash("message","Pages Records deleted Successully");
         Session::flash("color","danger");
         return back();
     }
     public function show($id)
     {
         $view_products = Pages::find($id);
   
         return response()->json($view_products);
     }
    }