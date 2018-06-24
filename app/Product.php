<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'product_id';

    public function salesdetails()
    {
        return $this->hasMany('App\Sales_details', 'product_id');
    }
}
