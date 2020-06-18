<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Subcategory extends Model
{
    protected $table = 'sub_category';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'item_count', 'status', 'category_id'
    ];

    public function category(){
        $c = Category::find($this->category_id);
        return $c->name;
    }

}
