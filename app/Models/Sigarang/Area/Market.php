<?php

namespace App\Models\Sigarang\Area;

use App\Base\BaseModel;

/**
 * @property string $id
 * @property string $name
 * @property string $district_id
 * 
 * @property District $district
 */

class Market extends BaseModel
{
    protected $table = "sig_m_markets";
    protected $fillable = [
        "name",
        "district_id",
    ];
    
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}

