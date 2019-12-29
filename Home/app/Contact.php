<?php

namespace App;

use App\User;
use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use Searchable;
    
    protected $guarded = [];

    protected $dates = ['birthday'];

    // Called from the contact resource file
    public function path()
    {
        return url('/contacts/' . $this->id);
    }

    public function scopeBirthdays($query)
    {
        return $query->whereRaw('birthday like "%-' . now()->format('m') . '-%"');
    }


    // Mutator to make the contacts birthday an instance of Carbon
    public function setBirthdayAttribute($birthday)
    {
        $this->attributes['birthday'] = Carbon::parse($birthday);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}