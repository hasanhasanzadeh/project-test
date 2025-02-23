<?php

namespace App\Models;

use App\Base\Trait\HasRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Permission\Traits\HasRoles;

class Cost extends Model
{

    use HasFactory, HasRules, Sortable, HasRoles;
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

    protected static array $rules = [
        'amount'=>'required|numeric|min:1000',
        'description'=>'nullable|string|min:3|max:150',
        'category_id'=>'required|integer|exists:categories,id',
        'shaba'=>'required|string|ir_sheba|size:26',
        'note'=>'nullable|string|min:3|max:150',
        'cost_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
