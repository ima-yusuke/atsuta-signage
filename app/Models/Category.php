<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img',
        'order',
        'parent_id',
    ];

    // 子カテゴリとのリレーション
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // 親カテゴリとのリレーション
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // コンテンツとのリレーション
    public function contents()
    {
        return $this->hasMany(Content::class, 'category_id')->orderBy('order');
    }
}
