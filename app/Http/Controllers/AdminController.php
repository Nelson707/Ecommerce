<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = category::all();
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $data = new category;
        $data->category_name = $request->category;
        $data->save();
        return redirect()->back()->with('message','Category added successfully');

    }

    public function delete_category($id)
    {
        $data = category::find($id);
        $data->delete();
        return redirect()->back()->with('message','Category deleted successfully');
    }

//    products
    public function view_product()
    {
        $category = category::all();
        return view('admin.products', compact('category'));
    }

    public function add_product(Request $request)
    {
        $product = new product;

        $product->title=$request->title;
        $product->description=$request->product_description;
        $product->price=$request->product_price;
        $product->discount_price=$request->dis_price;
        $product->quantity=$request->product_quantity;
        $product->category=$request->product_category;

        $image = $request->image;
//        giving the image a unique name with time function
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product_images',$imagename);
        $product->image = $imagename;

        $product->save();

        return redirect()->back()->with('message','Product added successfully');

    }

    public function show_product()
    {
        $product = product::all();
        return view('admin.show',compact('product'));
    }

}
