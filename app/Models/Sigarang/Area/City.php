<?php

namespace App\Models\Sigarang\Area;

use App\Base\BaseModel;

/**
 * @property string $id
 * @property string $name
 * @property string $province_id
 * 
 * @property Province $province
 */

class City extends BaseModel
{
    protected $table = "sig_m_cities";
    protected $fillable = [
        "name",
        "province_id",
    ];
    
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}

