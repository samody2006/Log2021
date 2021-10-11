<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'riderNo','password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function generateUniqueCode()
    // {
    //     do {
    //         $riderNo = random_int(10000, 99999);
    //     } while (Rider::where("riderNo", "=", $riderNo)->first());
  
    //     return $riderNo;
    // }
}
