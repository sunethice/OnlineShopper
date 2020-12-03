<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCarts;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class ShoppingCartsController extends Controller
{
    //
    public function cpGetCart(Request $request){
        return response()->json(ShoppingCarts::select('product_id','product_name','price','quantity')->where('user_id',"=",1)->get(),200);
    }

    public function cpUpdateCart(Request $request){
        $cart = $request['cart'];
        try{
            DB::beginTransaction();
            foreach($cart as $product){
                $cartItem = ShoppingCarts::where([
                    ['product_id','=',$product["product_id"]],
                    ['user_id','=',$request['user']]
                ])->first();
                if(is_null($cartItem)){
                    $newCartItem = new ShoppingCarts;
                    $newCartItem->product_id = $product["product_id"];
                    $newCartItem->product_name = $product["name"];
                    $newCartItem->user_id = $request['user'];
                    $newCartItem->price = $product["price"];
                    $newCartItem->quantity = $product["quantity"];
                    $newCartItem->save();
                }
                else{
                    $cartItem->quantity = $product["quantity"];
                    $cartItem->save();
                }
            }
            $cartUpdate = $this->cpGetCart($request);
            DB::commit();

            return response([
                'message'=>"Cart updated successfully",
                'cart' => $cartUpdate
            ],200);
        }
        catch(PDOException $ex){
            DB::rollBack();
            return response(['message'=>$ex->getMessage()],422);
        }
    }

    public function cpCreateCart(Request $request){

    }
}
