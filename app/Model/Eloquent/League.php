<?php
declare(strict_types=1);

namespace App\Model\Eloquent;

use App\Contracts\Domain\ModelContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class League extends Model implements ModelContract
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'kana',
        'slug',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
