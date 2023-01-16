<?php
namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Component\Process\Process;
/**
 * The order.placed event is dispatched each time an order is created
 * in the system.
 */
class OrderPlacedEvent extends Event
{
    public const NAME = 'order.placed';

    public function __construct()
    {
    }
       

}