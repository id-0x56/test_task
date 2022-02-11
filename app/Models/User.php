<?php

namespace App\Models;

use App\Actions\SettingActions;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MoneyController;
use App\Http\Controllers\PointController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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
        ItemController::class,
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
        $totalMoneyCount = TotalMoney::query()->first()->count ?? 0;
        $setting = Setting::query()->first();

        // remove money from presents
        if ($totalMoneyCount < (new SettingActions($setting))->getParams()->max_money) {
            if (($key = array_search(MoneyController::class, self::$presents)) !== false) {
                unset(self::$presents[$key]);
            }
        }

        return collect(self::$presents);
    }

    public function items(): HasManyThrough
    {
        return $this->HasManyThrough(
            TotalItem::class,
            Item::class,
            'user_id',
            'id',
            'id',
            'item_id',
        );
    }
}
