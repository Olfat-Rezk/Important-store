<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use PhpParser\Node\Stmt\Static_;

class Product extends Model
{
    use HasFactory;
    protected static function booted(){
        Static::addGlobalScope('store',new StoreScope());
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function scoprActive(Builder $builder){
        $builder->where('status','=','active');
    }
}
