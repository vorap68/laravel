<?php

namespace App\Classes;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Services\CurrencyConversion;

 
class Basket {
    
    protected $order;
    
    public function __construct($createOrder = false) {
        $order = session('order');
        if(is_null($order) && $createOrder){
             $data = [];
            if (Auth::check()) {
                $data['user_id'] = Auth::id();
            }
            $data['currency_id'] = CurrencyConversion::getCurrentCurrencyFromSession()->id;
            $this->order = new Order($data);
            session(['order'=>$this->order]);
        }else{
        $this->order = $order;
       //dd($order);
    }
    }
    
    public function getOrder() {
        return $this->order;
    }
    
    public function countAvaliable($updateCount = false) {
        
        $products = collect([]);
        foreach ($this->order->products as $orderProduct){
            $product = Product::where('id',$orderProduct->id)->first();
           $productCount = $product->count;
            $zakazCount = $orderProduct->countInOrder;
            if($productCount < $zakazCount){
                //dd($productCount,$zakazCount);
                return false;
            }
            if($updateCount){
//здесь мы уменьшаем кол-во товара в таблице pivot на то кол-во которое было заказано
                $product->count -= $orderProduct->countInOrder;
                $products ->push($product);
            }
        }
        if($updateCount){
             $products->map->save();
            //здесь мы уменьшаем кол-во товара в таблице products на то кол-во которое было заказано
        }
        return true;
    }
    
    public function saveOrder($name,$phone) {
        if(!$this->countAvaliable(true)){
            return false;
        }
            
       return  $this->order->saveOrder($name, $phone);
    }
    
    public function removeProduct(Product $product) {
        //dd($this->order->products->contains($product));
         if ($this->order->products->contains($product->id)) {
           $pivotRow = $this->order->products->where('id',$product->id)->first();
            if ($pivotRow->countInOrder < 2) {
                $this->order->products->pop($product->id);
                // Это моя строка
                //session()->forget('orderId');
            } else {
               $pivotRow->countInOrder--;
               
            }
        }
         session()->flash('warning','Удaлен товар:'.$product->name);
      }
    
    public function addProduct(Product $product) {
       
//Проверяем есть ли такой-же товар в корзине
        //dd($product->countInOrder,$product->count);
        if($this->order->products->contains($product)){
            $pivotRow = $this->order->products->where('id',$product->id)->first();
           // dd($pivotRow);
          if( $pivotRow->countInOrder >= $product->count){
                return false;
            }
            $pivotRow->countInOrder++;
           // dd($product->countInOrder);
           } else {
            if($product->count == 0){
                return false;
            }
            //Laravel должен знать о сущ pivot таблицы (есть метод products()) и по этой команде
        // в таблице pivot появл нов запись с order_id и product_id
        //dd($this->order->products);
            $product->countInOrder = 1;
        $this->order->products->push($product); 
       
        }
//         Order::changeFullSum($product->price);
        return true;
       }
}
