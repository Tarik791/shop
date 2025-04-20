<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['uuid', 'title', 'handle', 'price'];

    public function variants()
    {
        return $this->hasMany(Variant::class, 'product_id', 'uuid');
    }

    public function images()
    {
        return $this->hasManyThrough(Image::class, Variant::class, 'product_id', 'uuid', 'uuid', 'image_id');
    }
}
?>