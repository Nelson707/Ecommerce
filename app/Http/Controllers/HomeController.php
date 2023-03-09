<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $product = product::paginate(3);
        return view('home.userpage', compact('product'));
    }
    public function redirect()
    {
        $role=Auth::user()->getAttributeValue('role');
        if($role=="1")
        {
            return view('admin.home');
        }
        else
        {
            $product = product::paginate(3);
            return view('home.userpage', compact('product'));
        }
    }

    public function product_details($id)
    {
        $product = product::find($id);

        return view('home.product_details', compact('product'));
    }
}
