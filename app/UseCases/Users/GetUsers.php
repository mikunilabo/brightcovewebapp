<?php
declare(strict_types=1);

namespace App\UseCases\Users;

use App\Contracts\Domain\UseCaseContract;
// use App\Services\DomainCollection;
// use Domain\Contracts\Model\FindableContract;
// use Domain\Exceptions\NotFoundException;
// use Domain\Models\Store;
// use Domain\Models\User;

final class GetUsers implements UseCaseContract
{
    /** @var FindableContract */
    private $finder;

     /**
     * @param FindableContract $finder
     * @return void
     */
    public function __construct(/*FindableContract $finder*/)
    {
//         $this->finder = $finder;
    }

    /**
     * @param User $user
     * @param Store $store
     * @param array $args
     * @return mixed
     */
    public function excute(/*User $user, Store $store, */...$args)
    {
        dd($args);

//         $args = $this->domainize($user, $args);

        return $user->all();
    }

    /**
     * @param User $user
     * @param array $args
     * @return array
     */
//     private function domainize(User $user, array $args = []): array
//     {
//         /** @var Collection $collection */
//         $collection = collect($args);

//         if ($collection->has($key = 'mourning_flag') && ! is_null($collection->get($key))) {
//             $collection->put($key, ! ((bool)$collection->get($key)));
//         }

//         if ($collection->has($key = 'trashed')
//             && ($user->cant('authorize', config('permissions.groups.customers.restore'))
//                 || $user->cant('authorize', config('permissions.groups.customers.delete')))
//         ) {
//             $collection->forget($key);
//         }

//         $collection->put('relations', [
//             'store',
//             'visitedHistories',
//         ]);

//         return $collection->all();
//     }

}
