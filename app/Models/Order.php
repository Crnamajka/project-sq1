<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'order_date',
        'total_amount',
        'country',
        'first_name',
        'email',
        'last_name',
        'address',
        'city',
        'postal_code'
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    
   
}
