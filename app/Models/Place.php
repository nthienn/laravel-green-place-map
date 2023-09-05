<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'placeName', 
        'lat', 
        'lng', 
        'address', 
        'image', 
        'description', 
        'status', 
        'star', 
        'id_place_type', 
        'id_user',
        'id_approve'
    ];
    protected $primaryKey = 'id_place';
    protected $table = 'places';

    public function place_type()
    {
        return $this->belongsTo(PlaceType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approve()
    {
        return $this->belongsTo(Approve::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function criterias()
    {
        return $this->hasMany(Criteria::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'id_place');
    }
}
