<?php declare(strict_types=1);

namespace App\Lambda\Components\Handlers;

use Bref\Context\Context;
use Bref\Event\DynamoDb\DynamoDbEvent;
use Bref\Event\DynamoDb\DynamoDbHandler;
use Illuminate\Support\Facades\Cache;

class StreamDynamoDbHandler extends DynamoDbHandler
{
    public function handleDynamoDb(DynamoDbEvent $event, Context $context): void
    {
        foreach ($event->getRecords() as $record) {
            dump($record, $record->getEventName());

            if ($record->getEventName() == 'INSERT') {
                if (! Cache::has('connected')) {
                    Cache::put('connected', 1);
                }
                else {
                    Cache::increment('connected');
                }
            }

            if ($record->getEventName() == 'REMOVE') {
                Cache::decrement('connected');
            }

            if(Cache::get('connected') < 0) {
                Cache::put('connected', 1);
            }

            dump(Cache::get('connected'));
        }
    }
}
