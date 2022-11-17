<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    public function AssetCategory(){
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    public function division(){
        return $this->belongsTo(Division::class, 'division_id');
    }
}
