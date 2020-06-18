<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;

class CategoryItem extends Pivot
{
    public $timestamps = false;
    protected $table = 'category_and_item';
    protected $fillable = [
        'sub', 'item'
    ];

    public static function DeleteRelation($item, $sub){
        DB::table('category_and_item')->where('item', '=', $item)->where('sub', '=', $sub)->delete();;
    }
}
