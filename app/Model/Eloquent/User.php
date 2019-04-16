<?php
declare(strict_types=1);

namespace App\Model\Eloquent;

use App\Contracts\Domain\ModelContract;
use App\Traits\Database\Eloquent\Observers\UserObservable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;

final class User extends Authenticatable implements ModelContract
{
    use Notifiable, UserObservable;

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'company',
        'role_id',
        'password',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return HasMany
     */
    public function loginHistories(): HasMany
    {
        return $this->hasMany(LoginHistory::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * @return void
     */
    public function generateUuid4(): void
    {
        do {
            $this->id = Uuid::uuid4()->toString();
        } while ($this->find($this->id));
    }
}
