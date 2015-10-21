<?php namespace Stevenmaguire\Laravel\Test;

use Ramsey\Uuid\Uuid;

class UuidModelTest extends \PHPUnit_Framework_TestCase
{
    public function testAssignUuidValues()
    {
        $model = new ConcreteModelTest;
        $primaryKey = $model->getKeyName();
        $attributes = array_merge($model->uuidAttributes, [$primaryKey]);

        ConcreteModelTest::setUuidAttributes($model);

        array_map(function ($attribute) use ($model) {
            $this->assertTrue(isset($model->$attribute));
            $this->assertTrue(is_string($model->$attribute));
            $this->assertTrue(Uuid::isValid($model->$attribute));
        }, $attributes);
    }
}
