<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ShoppingCarts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
                $itemInStock = Product::select('product_id', 'stock', 'name')
                    ->where('product_id', '=', $item['product_id'])
                    ->lockforupdate()
                    ->get();
                if ($itemInStock['stock'] >= $item['quantity']) {
                    $mOrder = new Order();
                    $mOrder->order_id = $mOrderID;
                    $mOrder->product_id = $item['product_id'];
                    $mOrder->user_id = $item['user_id'];
                    $mOrder->quantity = $item['quantity'];
                    $mOrder->address = $item['address'];
                    $mOrder->save();

                    $mCartEntry = ShoppingCarts::where('product_id', '=', $item['product_id'])
                        ->where('user_id', '=', $item['user_id'])->find(1);
                    $mCartEntry->delete();
                } else {
                    DB::rollback();
                    $mRespMsg = "$itemInStock->name is out of stock.";
                    $mRespStatus = 422;
                    return response(['message' => $mRespMsg], $mRespStatus);
                }
            }
        } catch (PDOException $ex) {
            DB::rollback();
            return response(['message' => "Order counld not be processed."], 422);
        }
        DB::commit();
    }
}
