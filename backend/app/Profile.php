<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Set mass-assignable fields
    protected $fillable = ['user_id', 'phone', 'mobile', 'address', 'city', 'state', 'zip', 'image'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
