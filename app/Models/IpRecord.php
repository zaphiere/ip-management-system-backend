<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{
    Builder,
    Model,
    SoftDeletes
};

class IpRecord extends Model
{
    use SoftDeletes;
    use HasFactory;

    /**
     * Mass assignable attributes.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ip_address',
        'label',
        'comment',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ip_address_records';

    /**
     * Casted attributes.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Search Query for IP Address Records
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array<string, mixed> $search
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $query, array $search)
    {
        if (isset($search['ip_address'])) {
            $query->where('ip_address', 'LIKE', '%' . $search['ip_address'] . '%');
        }

        if (isset($search['label'])) {
            $query->where('label', 'LIKE', '%' . $search['label'] . '%');
        }

        if (isset($search['comment'])) {
            $query->where('comment', 'LIKE', '%' . $search['comment'] . '%');
        }

        return $query;
    }
}
