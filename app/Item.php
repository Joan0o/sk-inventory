<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status', 'sub_category_id'
    ];

    public function subcategories()
    {
        $sql = "items.id as item, sub_category.id as sub ";

        $results = DB::table(DB::raw("items 
        INNER JOIN category_and_item r ON (items.id = r.item)
        INNER JOIN sub_category ON (r.sub = sub_category.id)"))
            ->select(DB::raw($sql))->where('items.id', '=', $this->id)->get();
        return $results;
    }
}
