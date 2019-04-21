<?php
declare(strict_types=1);

namespace App\Model\Eloquent;

use App\Contracts\Domain\ModelContract;
use App\Traits\Database\Eloquent\Observers\UserObservable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;

final class User extends Authenticatable implements ModelContract
{
    use Notifiable, SoftDeletes, UserObservable;

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
     * @return BelongsToMany
     */
    public function leagues(): BelongsToMany
    {
        return $this->belongsToMany(League::class)->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function universities(): BelongsToMany
    {
        return $this->belongsToMany(University::class)->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function sports(): BelongsToMany
    {
        return $this->belongsToMany(Sport::class)->withTimestamps();
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

    /**
     * @param string $related
     * @param array $args
     * @return void
     */
    public function sync(string $related, array $args = []): void
    {
        /** @var \Illuminate\Database\Eloquent\Relations\BelongsToMany $builder */
        $builder = $this->{$related}();
        $relations = $builder->get();
        $related = $builder->getRelated();
        $sync = [];

        foreach ($args as $name) {

            if (is_null($model = $relations->firstWhere('name', $name))) {
                $model = $related->updateOrCreate(['name' => $name]);
            }

            $sync[] = $model->id;
        }

        $builder->sync($sync);
    }
}
