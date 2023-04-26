<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PropertyOptions;
use App\Models\Product;

class Property extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];
    
    public function propertyOptions() {
        return $this->hasMany(PropertyOptions::class);
    }
    
     public function products($param) {
        return $this->belongsToMany(Product::class);
    }
}
