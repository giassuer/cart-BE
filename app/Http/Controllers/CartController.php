<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CartRequest;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $product = Cart::get();
            return response()->json(
                [
                    'count' => $product->count(),
                    'products' => $product
                ]
            );
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something has happened',
                'errors' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = new Cart($request->all());
            $product->save();
            Db::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Something has happened',
                'errors' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Cart::where('id', $id)->first();
            $action = $request->input('action');

            if ($action === 'add') {
                $product->quantity += 1;
            } elseif ($action === 'subtract') {
                if ($product->quantity > 0) {
                    $product->quantity -= 1;
                }
            }
            $product->save();
            DB::commit();
            return response()->json([
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e,
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
