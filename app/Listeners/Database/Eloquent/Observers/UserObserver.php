<?php
declare(strict_types=1);

namespace App\Listeners\Database\Eloquent\Observers;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

final class UserObserver
{
    /**
     * @param Model $model
     * @return mixed
     */
    public function creating(Model $model)
    {
        do {
            $uuid = Uuid::uuid4()->toString();
        } while ($model->find($uuid));

        $model->id = $uuid;
    }

    /**
     * @param Model $model
     * @return mixed
     */
    public function updating(Model $model)
    {
        //
    }

    /**
     * @param Model $model
     * @return mixed
     */
    public function saving(Model $model)
    {
        //
    }

    /**
     * @param Model $model
     * @return mixed
     */
    public function deleting(Model $model)
    {
//         $model->email = null;
    }

    /**
     * @param Model $model
     * @return mixed
     */
    public function restoring(Model $model)
    {
        //
    }
}
