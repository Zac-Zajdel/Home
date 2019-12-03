<?php

namespace App;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  protected $guarded = [];

  protected $dates = ['birthday'];

  // Mutator to make the contacts birthday an isntance of Carbon
  public function setBirthdayAttribute($birthday)
  {
    $this->attributes['birthday'] = Carbon::parse($birthday);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
