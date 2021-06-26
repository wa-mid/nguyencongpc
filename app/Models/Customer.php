<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;

class Customer extends Authenticatable
{
    use Notifiable;

    // The authentication guard for admin
    protected $guard = 'web';
    protected $table = 'customers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','provider_name', 'provider_id', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function findByEmail($email) {
        $cacheKey = 'ncpc_customer_email_'.$email;
        $item = Cache::get($cacheKey);
        if($item == null) {
            $item = Customer::where('email', $email)->first();
            Cache::put($cacheKey, $item, 60);
        }
        return $item;
    }
    public static function findByProviderId($provider, $id) {
        $cacheKey = "ncpc_customer_provider_{$provider}_{$id}";
        $item = Cache::get($cacheKey);
        if($item == null) {
            $item = Customer::where('provider_name', $provider)->where('provider_id', $id)->first();
            Cache::put($cacheKey, $item, 60);
        }
        return $item;
    }

    public static function retrieveById($id) {
        $cacheKey = 'ncpc_customer_id_'.$id;
        $item = Cache::get($cacheKey);
        if($item == null) {
            $item = Customer::where('id', $id)->first();
            Cache::put($cacheKey, $item, 60);
        }
        return $item;
    }
}
