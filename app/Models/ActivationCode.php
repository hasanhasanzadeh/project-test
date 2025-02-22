<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivationCode extends Model
{
    use HasFactory;

    protected $table = "activation_codes";
    protected $fillable = [
        'used',
        'code',
        'user_id',
        'expired_at',
    ];

    public function scopeCreateCode($query, $user)
    {
        $code = $this->code();
        return $query->create([
            'user_id' => $user->id,
            'code' => $code,
            'expired_at' => Carbon::now()->addMinutes(5),
        ]);
    }

    private function code(): int
    {
        do {
            $code = mt_rand(10000, 99999);
            $check_code = static::whereCode($code)->get();
        } while (!$check_code->isEmpty());
        return $code;
    }

    /*
     * --------------------------------------------
     *              Relations
     * --------------------------------------------
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
