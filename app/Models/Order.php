<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Order extends Model
{
    use HasFactory; 
    protected $fillable = ['user_id','sum','currency_id'];
    
    public function products() {
        return $this->belongsToMany(Product::class)->withPivot(['count','price'])->withTimestamps();
    }
    
    public function calculateFullSum() {
         $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }
    
//    public static function  changeFullSum($changeSum) {
//        $sum = self::getFullSum() + $changeSum;
//        session(['get_order_sum'=>$sum]);
//    }
    public  function getFullSum() {
        $sum = 0;
        foreach ($this->products as $product) {
            $sum+=$product->price*$product->countInOrder;
        }
        return $sum;
        //return session('get_order_sum',0);
    }
    public static function eraseOrderSum(){
        session()->forget('get_order_sum');
    }
    
    public function saveOrder($name, $phone) {
      
        $this->name = $name;
        $this->phone = $phone;
        $this->status = 1;
        $this->sum = self::getFullSum();
       // dd($this);
        $products = $this->products;
         $this->save();
         foreach ($products as $productInOrder){
              $this->products()->attach($productInOrder, [
                'count' => $productInOrder->countInOrder,
                'price' => $productInOrder->price,
            ]);
         }
         session()->forget('order');
        return true;
        
    }
}
