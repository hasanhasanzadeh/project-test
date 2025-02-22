<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Base\Trait\HasRules;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRules, HasApiTokens, Sortable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'national_code',
        'password',
        'email_verified_at',
        'mobile_verified_at'
    ];

    public array $sortable = [
        'name',
        'email',
        'mobile',
        'national_code',
        'created_at',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mobile_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJoinAttribute(): string
    {
        $diffInYears = round($this->created_at->diffInYears(Carbon::now()));
        $diffInMonths = $this->created_at->diffInMonths(Carbon::now()) % 12;
        $diffInDays = $this->created_at->diffInDays(Carbon::now()) % 30;
        $diffInHours = $this->created_at->diffInHours(Carbon::now()) % 24;
        $diffInMinutes = $this->created_at->diffInMinutes(Carbon::now()) % 60;
        return $diffInYears.' سال و '.$diffInMonths.' ماه و '.$diffInDays.' روز و '.$diffInHours.' ساعت و '.$diffInMinutes.'  دقیقه ';
    }

    protected static array $rules = [
        'name' => 'nullable|string|min:3|max:150',
        'national_code' => 'nullable|numeric|ir_national_code|digits:10',
        'email' => 'required|email|max:255|unique:users,email',
        'mobile' => 'nullable|ir_mobile:zero|max:11|unique:users,mobile',
        'password' => 'required|string|min:6|max:32',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    /*
     * --------------------------------------------
     *              Relations
     * --------------------------------------------
     */
    public function avatar(): morphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
