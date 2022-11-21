<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetCategory extends Model
{
    use HasFactory;

    public function assets(){
        return $this->hasMany(Asset::class);
    }

    public function DeletedAssets(){
        return $this->hasMany(DeletedAsset::class);
    }
}
