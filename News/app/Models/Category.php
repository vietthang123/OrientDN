<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Category extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'categories';

    protected $appends = ['children_categories','posts'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'parent_id',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function parentCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function getChildrenCategoriesAttribute(){
        return $this
            ->where('id','!=', $this->id)
            ->where('parent_id','=', $this->id)
            ->get();
    }

    public function getPostsAttribute(){
        return empty($this->children_categories)? [] :
            $this
            ->select('posts.*')
            ->join('category_post','category_post.category_id','categories.id')
            ->join('posts','category_post.post_id','posts.id')
            ->where('category_post.category_id', $this->id)
            ->get();
    }
}