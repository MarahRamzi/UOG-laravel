<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\ResetPasswordNotification;
use Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'first_name',
        'last_name',
        'is_admin',
        'is_active',
        'password',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        // 'created_at',
        // 'updated_at',
        // 'deleted_at',
        // 'first_name',
        // 'last_name',
    ];

    protected $appends = [
        'full_name',
        // 'addresses'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFullNameAttribute()
    {
    	return ("{$this->first_name} {$this->last_name}");
    }

    protected function addresses():CastsAttribute
   {
        return CastsAttribute::make(
            get: fn (mixed $value, array $attributes) => new Address(
                $attributes['district'],
                $attributes['street'],
                $attributes['phone'],
                $attributes['city_id'],


            ),
            set: fn (Address $value) => [
                'district' => $value->district,
                'street' => $value->street,
                'phone' => $value->phone,
                'city_id' => $value->city_id,

            ],
        );
   }

    public function sendPasswordResetNotification($token): void
    {
        $url = 'https://example.com/reset-password?token='.$token;

        $this->notify(new ResetPasswordNotification($url));
    }

    public function scopeFilterByAttribute($query, $attributeValue)
    {
        return $query->where('is_active', $attributeValue);
        return $query->where('is_admin', $attributeValue);

    }

    public function PurchaseOrders(){
        return $this->hasMany(PurchaseOrder::class , 'user_id', 'id');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable' );
    }

}