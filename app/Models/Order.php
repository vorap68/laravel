<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;
    
    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }
    
    public function calculateFullSum() {
         $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }
    
    public static function  changeFullSum($changeSum) {
        $sum = self::getFullSum() + $changeSum;
        session(['get_order_sum'=>$sum]);
    }
    public static function getFullSum() {
        return session('get_order_sum',0);
    }
    public static function eraseOrderSum(){
        session()->forget('get_order_sum');
    }
    
    public function saveOrder($name, $phone) {
        if($this->status == 0){
        $this->name = $name;
        $this->phone = $phone;
        $this->status = 1;
        $this->sum = self::getFullSum();
         $this->save();
         session()->forget('orderId');
        return true;
        }else{
           return false;
        }
    }
}
