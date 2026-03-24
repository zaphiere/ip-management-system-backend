<?php

namespace App\Models;

use App\Enums\{
    Action,
    EntityType
};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'action',
        'entity_type',
        'entity_id',
        'description',
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
    ];
}
