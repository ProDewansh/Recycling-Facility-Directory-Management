<?php

// app/Models/Facility.php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model {
    use HasFactory;
    protected $fillable = ['business_name','last_update_date','street_address','city','state','postal_code'];

    public function materials() {
        return $this->belongsToMany(Material::class);
    }
}

