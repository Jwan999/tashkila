<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class APIController extends Controller
{

    public function getProduct(Request $request)
    {
        return Response::json([
            "product" => Product::with('shop')->find($request->id)
        ]);
    }

    public function getCartProducts(Request $request)
    {
        return Response::json([
            "products" => Product::findMany($request->ids)
        ]);
    }

    public function getProducts(Request $request)
    {
//        dd($request->shop != null);
        if ($request->shop != null) {

            $products = Product::where('shop_id', $request->shop)->get();

        } else {
            $products = Product::all();
        }
        return Response::json([
            "products" => $products
        ]);


    }

    public function getTopPicks()
    {

        $picks = Product::where('top_picks', 'true')->get();

        return Response::json([
            "picks" => $picks
        ]);

    }

    public function getShops()
    {
//        dd('test');
        $shops = Shop::all();
        return Response::json([
            "shops" => $shops
        ]);
    }

    public function getCustomerOrders(Request $request)
    {

        $orders = Order::whereEmail($request->email)->with("items.product")->get();
//        $orders = Order::where('email', $request->email)->with('items.product')->get();
        return Response::json([
            "orders" => $orders,

        ]);

    }

    public function createOrder(Request $request)
    {
        $rules = $request->validate([
            'full_name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone_one' => 'required|numeric',
            'phone_two' => 'required|numeric',
            'closest_mark' => 'required',
            'payment_type' => 'required',
        ]);

        $order = new Order();
        $order->full_name = $request->full_name;
        $order->address = $request->address;
        $order->email = $request->email;
        $order->phone_one = $request->phone_one;
        $order->phone_two = $request->phone_two;
        $order->closest_mark = $request->closest_mark;
        $order->payment_type = $request->payment_type;
//        $order->customer_id = auth()->id();
        $order->total = $request->total;
        $order->save();
        foreach ($request->items as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item["product"]["id"];
            $orderItem->quantity = $item["quantity"];
            $orderItem->save();
        }
        return Response::json([
            "order" => $order
        ]);

    }
}
