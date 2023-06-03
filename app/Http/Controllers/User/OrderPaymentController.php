<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderPayment;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{

    public function index($id){

        $order = Order::with('carts','carts.product','carts.productItem','carts.productItem.productItemFeatures','orderPayment')->find($id);

        if($order->orderPayment->success){
            return view('user.error-page')->with([
                'code' => 502,
                'error' => 'Payment success',
                'message' => 'Please go to your orders',
                'redirect_text' => 'Go to orders',
                'redirect_url' => route('user.orders.index')
            ]);
        }



        return view('user.orders.payment')->with([
            'order'=>$order
        ]);
    }

    public static function makePayment($cardNumber,$expMonth,$expYear,$cvc,$email,$name,$address,$amount)
    {

    }




    public static function addPayment(Request $request): OrderPayment
    {

        $request->validate([
           'payment_type'=>'required',
        ]);

        $orderPayment = new OrderPayment();
        $orderPayment->payment_type = $request->payment_type;
        if(isset($request->payment_id)){
            $orderPayment->payment_id = $request->payment_id;
        }
        if(isset($request->success)){
            $orderPayment->success = $request->success;
        }
        $orderPayment->save();
        return $orderPayment;
    }
}
