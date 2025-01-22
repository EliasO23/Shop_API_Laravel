<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Exception;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\DB;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Orders::all();
        return response()->json([
            'message' => 'Get all orders',
            'data' => $orders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'product' => 'required|string|max:255',
                'quantity' => 'required|integer',
                'total' => 'required|numeric',
            ]);

            $order = Orders::create([
                'product' => $request->product,
                'quantity' => $request->quantity,
                'total' => $request->total,
                'user_id' => $request->user()->id,
            ]);

            return response()->json([
                'message' => 'Order created successfully',
                'data' => $order
            ], 201);
        } catch (Exception $error) {
            return response()->json([
                'error' => $error->getMessage()
            ], 400);
        }
    }

    /**
     * Show orders of user with ID 2.
     */
    public function showOrdersById($userId = 2)
    {
        $orders = Orders::where('user_id', $userId)->get();
        return response()->json([
            'message' => 'Get all orders by Id ' . $userId,
            'data' => $orders
        ]);
    }

    /**
     * Get all orders with user details.
     */
    public function ordersWithUserDetails()
    {
        $orders = Orders::with(['user:id,name,email'])->get();
        return response()->json([
            'message' => 'Get all orders',
            'data' => $orders
        ]);
    }

    /**
     * Get all orders between 100 and 250.
     */
    public function ordersInRange()
    {
        $orders = Orders::whereBetween('total', [100, 250])->get();
        return response()->json([
            'message' => 'Get all orders between ',
            'data' => $orders
        ]);
    }

    /**
     * Get total orders by user ID.
     */
    public function totalOrdersById($orderId = 5)
    {
        $orderCounts = Orders::where('user_id', $orderId)->count();
        return response()->json([
            'message' => 'Total orders by Id ' . $orderId,
            'total' => $orderCounts,
            'data' => Orders::where('user_id', $orderId)->get()
        ]);
    }

    /**
     * Get all orders in descending order.
     */
    public function ordersDetailsDesending()
    {
        $orders = Orders::with('user:id,name,email,phone')->orderBy('total', 'desc')->get();
        return response()->json([
            'message' => 'Get all orders in descending order',
            'data' => $orders
        ]);
    }

    /**
     * Get total sum of orders.
     */
    public function totalSum()
    {
        $totalSum = Orders::sum('total');
        return response()->json([
            'message' => 'Total sum of orders',
            'total' => $totalSum
        ]);
    }

    /**
     * Get economic order.
     */
    public function economicOrder()
    {
        $orders = Orders::with('user:id,name,email,phone')->where('total', Orders::min('total'))->get();
        return response()->json([
            'message' => 'Get economic order',
            'data' => $orders
        ]);
    }

    /**
     * Get all orders grouped by user.
     */
    public function ordersOfUsers()
    {
        try {
            // Cargar usuarios con sus pedidos
            $users = Users::with('orders')->get();

            // Transformar la información
            $result = $users->map(function ($user) {
                return [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'orders' => $user->orders->map(function ($order) {
                        return [
                            'order_id' => $order->id,
                            'product' => $order->product,
                            'quantity' => $order->quantity,
                            'total' => $order->total,
                        ];
                    }),
                ];
            });

            return response()->json([
                'message' => 'Orders grouped by user retrieved successfully',
                'data' => $result
            ], 200);

        } catch (Exception $error) {
            return response()->json([
                'message' => 'Error retrieving orders',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
