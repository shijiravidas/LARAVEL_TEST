<?php

namespace App\Test;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    protected $primaryKey = 'id';
    protected $table='licence_details';
    protected $fillable=['office','licence_no','licence_date','licence_name','licence_address','licence_type'];
}
