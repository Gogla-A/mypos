<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){

    }

    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create', compact('client'));
    }

    public function store(Request $request, Client $client)
    {

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
