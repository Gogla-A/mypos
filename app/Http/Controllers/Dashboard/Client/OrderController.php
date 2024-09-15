<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){

    }

    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.create', compact('client', 'categories', 'orders'));
    }

    public function store(Request $request, Client $client)
    {
        $request -> validate([
           'products' => 'required|array',
        ]);

        $order = $client->orders()->create([]);
        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::findOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];

            $product->update([
               'stock' => $product->stock - $quantity['quantity']
            ]);
        }
        $order->update([
            'total_price' => $total_price
        ]);
dd($order->total_price);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.orders.index');

    }

    public function edit(Client $client, Client $order)
    {

    }

    public function update(Request $request, Client $client, Order $order)
    {

    }

    public function destroy(Client $client, Order $order)
    {

    }
}
