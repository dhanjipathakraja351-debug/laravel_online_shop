<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomersAddress extends Model
{
    protected $fillable = [
    'user_id','subtotal','shipping','coupon_code','discount','grand_total',
    'first_name','last_name','email','phone','address','city','state','country','zip'
 ];

}
