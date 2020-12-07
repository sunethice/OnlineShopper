<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ShoppingCarts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mockery\Undefined;
use PDOException;

class OrderController extends Controller
{
    public function cpCheckout(Request $request)
    {
        $mRespMsg = "";
        $mRespStatus = 200;
        $mCart = $request['cart'];
        try {
            DB::beginTransaction();
            $mOrderID = (string) Str::uuid();
            foreach ($mCart as $item) {
                $itemInStock = Product::select('product_id', 'stock', 'product_name')
                    ->where('product_id', '=', $item['product_id'])
                    ->lockforupdate()
                    ->first();
                // return response()->json($itemInStock->stock, 200);
                if ($itemInStock->stock >= $item['quantity']) {
                    $mOrder = new Order();
                    $mOrder->order_id = $mOrderID;
                    $mOrder->product_id = $item['product_id'];
                    if (isset($request['user']))
                        $mOrder->user_id = $request['user'];
                    else {
                        $validator = Validator::make($request->all(), [
                            'name' => 'required|string',
                            'email' => 'required|string|email|max:255',
                            'address' => 'required|string'
                        ]);
                        if ($validator->fails()) {
                            return response(['errors' => $validator->errors()->all()], 422);
                        } else {
                            $mOrder->user_name = $request['name'];
                            $mOrder->email = $request['email'];
                            $mOrder->address = $request['address'];
                        }
                    }
                    $mOrder->quantity = $item['quantity'];
                    $mOrder->save();
                    if (isset($request['user'])) {
                        $mCartEntry = ShoppingCarts::where('product_id', '=', $item['product_id'])
                            ->where('user_id', '=', $request['user'])->delete();
                    }
                } else {
                    DB::rollback();
                    $mRespMsg = "$itemInStock->name is out of stock.";
                    $mRespStatus = 422;
                    return response(['message' => $mRespMsg], $mRespStatus);
                }
            }
        } catch (PDOException $ex) {
            DB::rollback();
            return response(['message' => "Order could not be processed.", "errors" => $ex->getMessage()], 422);
        }
        DB::commit();
    }
}
