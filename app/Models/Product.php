<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
  use \Illuminate\Database\Eloquent\SoftDeletes;
  use App\Services\CurrencyConversion;
  use App\Models\Sku;
  use App\Models\Property;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
  
    
    protected $fillable = [
        'category_id','name','code','description','price','image','hit','new','recommend','count',
    ];
    
    public function category() {
        return $this->belongsTo(Category::class);
       }
       
    //продукт может быть один а товарнх предложений много   
    public function skus() {
        return $this->hasMany(Sku::class);
    }   
    
    public function properties() {
        return $this->belongsToMany(Property::class,'property_product')->withTimestamps();
    }
       
      public function getPriceForCount() {
             if(!is_null($this->pivot)){
                  return  $this->price * $this->pivot->count;
             }
               return $this->price;
    }
    
    public function scopeHit($query) {
       return $query->where('hit',1); 
    }
     public function scopeNew($query) {
       return $query->where('new',1); 
    }
     public function scopeRecommend($query) {
       return $query->where('recommend',1); 
    }
    
    public function isAvailable() {
        return $this->count > 0;
    }
    public function isNew() {
       return $this->new === 1; 
    }
    
    public function isHit() {
       return $this->hit === 1; 
    } 
    
     public function isRecommend() {
       return $this->recommend === 1; 
    }
    
    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }
    
    public function getPriceAttribute($value) {
        return CurrencyConversion::convert($value);
    }
    
    public function getCurrencyAttribute() {
        
    }
}
