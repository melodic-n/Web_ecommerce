<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'file'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    public function commande()
    {
        return $this->hasOne(Commande::class, 'user_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
    public function panier(): HasOne
    {
        return $this->hasOne(Panier::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            \Log::info('User created: ', ['user' => $user]);

            if ($user->role === 'admin') {
                Admin::create([
                    'user_id' => $user->id,
                ]);
            }
        });
    }
    
}
