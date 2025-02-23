<?php

namespace App\Models;

use App\Base\Trait\HasRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Permission\Traits\HasRoles;

class Category extends Model
{
    use HasFactory, Sortable, HasRoles, HasRules;
    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    public array $sortable = [
        'name',
        'created_at',
    ];

    protected static array $rules = [
        'name' => 'required|string|min:3|max:150|unique:categories,name',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];


    /*
     * --------------------------------------------
     *              Relations
     * --------------------------------------------
     */
    public function photo(): morphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
