<?php

namespace App\Event\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Tools\Event\GenerateSchemaEventArgs;

class MigrationEventSubscriber implements EventSubscriber
{
    /**
     * @return string[]
     */
    public function getSubscribedEvents(): array
    {
        return [
            'postGenerateSchema',
        ];
    }

    public function postGenerateSchema(GenerateSchemaEventArgs $Args): void
    {
        $Schema = $Args->getSchema();

        if (!$Schema->hasNamespace('public')) {
            $Schema->createNamespace('public');
        }
    }
}
