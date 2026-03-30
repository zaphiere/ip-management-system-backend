<?php

namespace App\Models;

use App\Enums\{
    Action,
    EntityType
};
use App\Models\{
    IpRecord,
    User,
};
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{
    Builder,
    Model,
};

class AuditLog extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'session_id',
        'action',
        'entity_type',
        'entity_id',
        'old_content',
        'new_content',
        'created_at',
        'updated_at',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'audit_logs';

    /**
     * Casted attributes.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'action' => Action::class,
        'entity_type' => EntityType::class,
        'old_content' => 'array',
        'new_content' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Implement relational value for user_id
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Implement relational value for entity_id
     * when entity_type is IP_ADDRESS
     */
    public function ipEntity()
    {
        return $this->belongsTo(IpRecord::class, 'entity_id')
            ->withTrashed();
    }

    /**
     * Implement relational value for entity_id
     * when entity_type is USER
     */
    public function userEntity()
    {
        return $this->belongsTo(User::class, 'entity_id');
    }

    /**
     * Search Query for Audit Logs
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array<string, mixed> $search
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $query, array $search)
    {
        if (isset($search['user_id'])) {
            $query->where('user_id', $search['user_id']);
        }

        if (isset($search['session_id'])) {
            $query->where('session_id', $search['session_id']);
        }

        if (isset($search['entity_type'])) {
            $query->where('entity_type', $search['entity_type']);
        }

        if (isset($search['entity_id'])) {
            $query->whereIn('entity_id', $search['entity_id']);
        }

        if (isset($search['action'])) {
            $query->where('action', $search['action']);
        }

        if (isset($search['start_date']) && isset($search['end_date'])) {
            $query->where('created_at', '>=', $search['start_date'])
                ->where('created_at', '<=', $search['end_date']);
        }

        return $query;
    }
}
