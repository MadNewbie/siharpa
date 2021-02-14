<?php

namespace App\Models\Sigarang\Goods;

use App\Base\BaseModel;

/**
 * @property string $id
 * @property string $name
 * @property string $unit_id
 * @property string $category_id
 * 
 * @property Unit $unit
 * @property Category $category
 */

class Goods extends BaseModel
{
    protected $table = "sig_m_goods";
    protected $fillable = [
        "name",
        "unit_id",
        "category_id",
    ];
    
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

