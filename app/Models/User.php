<?php

namespace App\Models;

use App\Http\Controllers\MoneyController;
use App\Http\Controllers\PointController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var array<int, string>
     */
    private static array $presents = [
        PointController::class,
        MoneyController::class,
//        ItemController::class,
    ];

    /**
     * @return HasOne
     */
    public function points(): HasOne
    {
        return $this->hasOne(Point::class);
    }

    /**
     * @return HasOne
     */
    public function moneys(): HasOne
    {
        return $this->hasOne(Money::class);
    }

    /**
     * @return Collection
     */
    public static function getAvailablePresents(): Collection
    {
        return collect(self::$presents);
    }
}
