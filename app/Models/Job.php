<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model{
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = ['title', 'salary'];

    public function employer()
    {
        return $this ->belongsTo(Employer::class);
    }


}


// Understanding
// post.php
//     return this->belongsTo(user)
//     return this->hasMany(comment)
//
// user.php
//     return hasMany(post)
//     return hasMany(comment)
//
// comments
//     return this->belongsTo(user)
//     return this->belongsTo(post)
