<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'offers';
    const ORM_TABLE_NAME = 'offers';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product',
        'price',
        'currency',
        'description',
        'ext_offer_id',
        'ext_shop_id'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the shop that owns the offer
     */
    public function shop(): belongsTo
    {
        return $this->belongsTo(Shop::class, 'ext_shop_id', 'ext_shop_id');
    }
}
