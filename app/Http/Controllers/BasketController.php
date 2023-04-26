<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Classes\Basket;

class BasketController extends Controller {

    public function basket() {
        $order = ((new Basket())->getOrder());
      return view('basket', compact('order'));
    }
    
     public function basketConfirm(Request $request) {
     $success = (new Basket())->saveOrder($request->name, $request->phone);
      //  $result = $order->saveOrder($request->name, $request->phone);
         if($success){
             session()->flash('success','Заказ сохранен');
         }else{
              session()->flash('warning','Заказ НЕ сохранен');
         }  
        return redirect()->route('index');
    }

    public function basketPlace() {
      $basket = new Basket();
        $order = $basket->getOrder();
        if (!$basket->countAvaliable()) {
            session()->flash('warning','Товар недоступен');
            return redirect()->route('basket');
        }
        return view('order', compact('order'));
    }
    
    public function basketAdd(Product $product) {
        $result = (new Basket(true))->addProduct($product);
      if ($result) {
            session()->flash('success', 'Товар'.$product->name.' добавлен');
        } else {
            session()->flash('warning','Товар'.$product->name.'не может быть добавлен');
        }
         
       
          return redirect()->route('basket');
    }
    
      public function basketRemove(Product $product) {
      
          (new Basket)->removeProduct($product);
//Laravel должен знать о сущ pivot таблицы (есть метод products()) и по этой команде
        // в таблице pivot появл нов запись с order_id и product_id
        return redirect()->route('basket');
    }
    
   

    public function basketClear() {
        session()->forget('orderId');
         $order = Order::create();
        return view('basket', compact('order'));
    }
}
