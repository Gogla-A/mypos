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

        $this->attach_order($request, $client);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.orders.index');

    }

    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.edit', compact('client', 'order', 'categories', 'orders'));

    }//end of edit

    public function update(Request $request, Client $client, Order $order)
    {
        $request -> validate([
            'products' => 'required|array',
        ]);

        $this->detach_order($order);
        $this->attach_order($request, $client);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.orders.index');
    }


    private function attach_order($request, $client)
    {
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

    } //end of attach_order

    private function detach_order($order) {
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
    } //end of detach order
}
