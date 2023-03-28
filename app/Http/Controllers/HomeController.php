<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
use Stripe;

class HomeController extends Controller
{
    public function index()
    {
        $product = product::paginate(6);
        $comment = comment::orderby('id','desc')->get();
        $reply = reply::all();
        return view('home.userpage', compact('product','comment','reply'));
    }
    public function redirect()
    {
        $role=Auth::user()->getAttributeValue('role');
        if($role=="1")
        {
            $total_products = product::all()->count();
            $total_orders = order::all()->count();
            $total_users = user::all()->count();

            $order = order::all();
            $total_revenue = 0;

            foreach ($order as $order)
            {
                $total_revenue = $total_revenue + $order->price;
            }

            $total_delivered = order::where('delivery_status','=','Delivered')->get()->count();

            $total_processing = order::where('delivery_status','=','Processing')->get()->count();


            return view('admin.home', compact('total_products','total_orders','total_users','total_revenue','total_delivered','total_processing'));

        }
        else
        {
            $product = product::paginate(6);

            $comment = comment::orderby('id','desc')->get();

            $reply = reply::all();

            return view('home.userpage', compact('product','comment','reply'));
        }
    }

    public function product_details($id)
    {
        $product = product::find($id);

        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {
        if (Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $product = product::find($id);

            $product_exist_id = cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();

            if ($product_exist_id)
            {
                $cart = cart::find($product_exist_id)->first();

                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;

                if ($product->discount_price!=null)
                {
                    $cart->price = $product->discount_price * $cart->quantity;
                }
                else
                {
                    $cart->price = $product->price * $cart->quantity;
                }

                $cart->save();
                return redirect()->back()->with('message', 'Product added to cart successfully');
            }
            else
            {
                $cart = new cart;

                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;

                $cart->product_title = $product->title;

                if ($product->discount_price!=null)
                {
                    $cart->price = $product->discount_price * $request->quantity;
                }
                else
                {
                    $cart->price = $product->price * $request->quantity;
                }

                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->quantity = $request->quantity;

                $cart->save();
                return redirect()->back()->with('message', 'Product added to cart successfully');
            }

        }
        else
        {
            return redirect('login');
        }

    }

    public function show_cart()
    {
        if (Auth::id())
        {
            $id = Auth::user()->getAttributeValue('id');
            $cart = cart::where('user_id','=',$id)->get();
            return view('home.show_cart', compact('cart'));
        }

        else
        {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {
        $cart = cart::find($id);
        $cart->delete();

        return redirect()->back()->with('message','Product removed successfully');
    }

    public function cash_order()
    {
        $user = Auth::user();
        $userid = $user->getAttributeValue('id');

        $data = cart::where('user_id','=',$userid)->get();

        foreach ($data as $data)
        {
            $order = new order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;

            $order->payment_status = 'Cash on delivery';
            $order->delivery_status = 'Processing';

            $order->save();

//            deleting from cart
            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();

        }

        return redirect()->back()->with('message','Order Received. We will communicate further instructions shortly');
    }

    public function stripe($totalPrice)
    {
        return view('home.stripe', compact('totalPrice'));
    }

    public function stripePost(Request $request, $totalPrice)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



        Stripe\Charge::create ([

            "amount" => $totalPrice * 100,

            "currency" => "usd",

            "source" => $request->stripeToken,

            "description" => "Thanks for your payment."

        ]);

        $user = Auth::user();
        $userid = $user->getAttributeValue('id');

        $data = cart::where('user_id','=',$userid)->get();

        foreach ($data as $data)
        {
            $order = new order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;

            $order->payment_status = 'Paid';
            $order->delivery_status = 'Processing';

            $order->save();

//            deleting from cart
            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();

        }

        Session::flash('success', 'Payment successful!');

        return back();

    }

    public function show_order()
    {
        if (Auth::id())
        {
            $user = Auth::user();
            $userId = $user->id;
            $order = order::where('user_id','=',$userId)->get();

            return view('home.order', compact('order'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order = order::find($id);
        $order->delivery_status = 'You cancelled the order';
        $order->save();
        return redirect()->back();
    }

    public function add_comment(Request $request)
    {
        if (Auth::id())
        {
            $comment = new comment;

            $comment->name = Auth::user()->name;

            $comment->user_id = Auth::user()->id;

            $comment->comment = $request->comment;

            $comment->save();

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    public function add_reply(Request $request)
    {
        if (Auth::id())
        {
            $reply = new reply;

            $reply->name = Auth::user()->name;

            $reply->user_id = Auth::user()->id;

            $reply->comment_id = $request->commentId;

            $reply->reply = $request->reply;

            $reply->save();

            return redirect()->back();

        }
        else
        {
            return redirect('login');
        }
    }

    public function product_search(Request $request)
    {
        $comment = comment::orderby('id','desc')->get();
        $reply = reply::all();

        $search_text = $request->search;

        $product = product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"$search_text")->paginate(10);

        return view('home.userpage',compact('product','comment','reply'));
    }

    public function all_products()
    {
        $product = product::paginate(10);
        $comment = comment::orderby('id','desc')->get();
        $reply = reply::all();
        return view('home.all_products', compact('product','comment','reply'));
    }

}
