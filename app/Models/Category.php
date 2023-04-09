<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'parent_id', 'name', 'description', 'image', 'status'];

    protected $guarded = [];
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
