<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
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

    public function delete_product($id)
    {
        $product = product::find($id);
        $product->delete();
        return redirect()->back()->with('message','Product deleted successfully');
    }

    public function update_product($id)
    {
        $product = product::find($id);
        $category = category::all();
        return view('admin.update_product', compact('product','category'));
    }

    public function update_product_confirm(Request $request,$id)
    {
        $product = product::find($id);

        $product->title = $request->title;
        $product->description=$request->product_description;
        $product->price=$request->product_price;
        $product->discount_price=$request->dis_price;
        $product->quantity=$request->product_quantity;
        $product->category=$request->product_category;

        $image = $request->image;

        if ($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();

            $request->image->move('product_images', $imagename);

            $product->image = $imagename;
        }

        $product->save();

        return redirect()->back()->with('message','Product Updated Successfully');
    }

    public function orders()
    {
        $order = order::all();
        return view('admin.orders', compact('order'));
    }

    public function delivered($id)
    {
        $order = order::find($id);
        $order->delivery_status = "Delivered";
        $order->payment_status = "Paid";
        $order->save();

        return redirect()->back();
    }
}
