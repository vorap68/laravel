<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\PropertyOptions;
 use \Illuminate\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
    use HasFactory;
     use SoftDeletes;
    
    protected $fillable =[
        'product_id','count','price',
    ];
    
    public function product() {
        return $this->belongsTo(Product::class);
    }
    
    public function property_options($param) {
        return $this->belongsToMany(PropertyOptions::class);
    }
}
