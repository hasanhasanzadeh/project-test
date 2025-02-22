<?php

namespace App\Models;

use App\Base\Trait\HasRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Cost extends Model
{

    use HasFactory, HasRules, Sortable;
    protected $table = 'costs';
    protected $fillable = [
        'amount',
        'description',
        'category_id',
        'user_id',
        'shaba',
        'status',
        'note',
        'cost_file_id'
    ];

    public array $sortable = [
        'amount',
        'status',
        'created_at'
    ];
    public function getStateAttribute():string
    {
        return match ($this->attributes['status']) {
            'pending' => 'در حال بررسی',
            'cancel' => 'کنسل شده',
            'fail' => 'پرداخت نشده',
            'accept' => 'پذیرش ',
            'done' => 'پرداخت شد',
            default => $this->attributes['status'],
        };
    }

    /*
     * --------------------------------------------
     *              Relations
     * --------------------------------------------
     */
    public function costFile(): belongsTo
    {
        return $this->belongsTo(File::class, 'cost_file_id', 'id');
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category(): belongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
