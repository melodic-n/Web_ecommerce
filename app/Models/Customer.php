<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'tel',
        'adresse',
        'panter_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createProfile(User $user, array $customerData): Customer
    {
        return $user->customer()->create($customerData);
    }
}