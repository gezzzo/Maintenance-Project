<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportMalfuncation extends Model
{
    use HasFactory;
    protected $fillable=[
        'mechanic_id','description','technical_id','malfunction_id','status','product','price'
    ];

}
