<?php

namespace App\Models\Sigarang\Area;

use App\Base\BaseModel;

/**
 * @property string $id
 * @property string $name
 * @property string $city_id
 *
 * @property City $city
 * @property Market $markets
 * @property DistrictArea $area
 */

class District extends BaseModel
{
    protected $table = "sig_m_districts";
    protected $fillable = [
        "name",
        "city_id",
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function area()
    {
        return $this->hasOne(DistrictArea::class);
    }

    public function markets()
    {
        return $this->hasMany(Market::class);
    }

    public function getProvinceName()
    {
        return $this->city->province->name;
    }
}

