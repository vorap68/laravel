<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Property;
use App\Models\Sku;

class PropertyOptions extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'name','property_id',
    ];
    
    public function property() {
        return $this->belongsTo(Property::class);
    }
    public function skus($param) {
        return $this->belongsToMany(Sku::class);
    }
}
