<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['id', 'parent_id', 'name', 'description', 'image', 'status'];
    
    public function products(){
        return $this->hasMany(Product::class);
    }

    protected $guarded = [];
    public function scopeActive(Builder $builder){
        $builder->where('status','=','active');

    }

    public function scopeStatus(Builder $builder,$status){
        $builder->where('status','=',$status);

    }
    public function scopeFilter(Builder $builder,$filters){
        if($filters['name'] ?? false){
            $builder->where('name','LIKE',"%{$filters['name']}%");
        }
        if($filters['status'] ??false){
            $builder->where('status','=',$filters['status']);
        }
    }
    public static function rules(){
        return [
            'name'=>'required|string|min:3|unique:categories,name,except,id',
            'parent_id'=>'int|exists:categories,id',
            'description'=>'sometimes|string',
            'image'=>'sometimes|mimes:png,jpg',
            'status'=>'required|in:active,archived'
        ];
    }
}
