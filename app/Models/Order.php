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
    
//    public function users() {
//        return $this->belongsTo($related)
//    }
    
    public function getFullSum() {
        $sum = 0;
        
        foreach ($this->products as $product) {
            $sum += $product->getPriceForCount();
        }
        return $sum;
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
