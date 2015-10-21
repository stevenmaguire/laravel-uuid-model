<?php namespace Stevenmaguire\Laravel\Test;

use Stevenmaguire\Laravel\UuidModel;

class ConcreteModelTest extends UuidModel
{
    /**
     * Auto-assigned uuid model attributes.
     *
     * @var array
     */
    public $uuidAttributes = ['foo', 'bar'];
}
