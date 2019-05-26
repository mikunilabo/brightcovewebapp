<?php
declare(strict_types=1);

namespace App\Services;

use Ramsey\Uuid\Codec\TimestampFirstCombCodec;
use Ramsey\Uuid\Generator\CombGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;

final class UtilitiesService
{
    /**
     * Generate a version 4 (random) UUID.
     *
     * @return string
     */
    public function uuid4(): string
    {
        return Uuid::uuid4()->toString();
    }

    /**
     * Generate a time-ordered UUID (version 4).
     *
     * @return string
     */
    public function orderedUuid(): string
    {
        $factory = new UuidFactory;

        $factory->setRandomGenerator(new CombGenerator(
            $factory->getRandomGenerator(),
            $factory->getNumberConverter()
        ));

        $factory->setCodec(new TimestampFirstCombCodec(
            $factory->getUuidBuilder()
        ));

        return $factory->uuid4()->toString();
    }
}
