<?php
declare(strict_types=1);

namespace App\Model\Eloquent;

use App\Contracts\Domain\ModelContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class LoginHistory extends Model implements ModelContract
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ip',
        'host',
        'user_agent',
        'remote_port',
        'access_port',
        'created_at',
    ];

    /**
     * @var array
     */
    protected $touches = [
        'user',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
