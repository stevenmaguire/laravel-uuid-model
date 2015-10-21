<?php namespace Stevenmaguire\Laravel;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Ramsey\Uuid\Uuid;

abstract class UuidModel extends Eloquent
{
    /**
     * Auto-assigned uuid model attributes.
     *
     * @var array
     */
    public $uuidAttributes = [];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Attach to the 'creating' Model Event to provide a UUID
         * for the `id` field (provided by $model->getKeyName())
         */
        static::creating(function ($model) {
            static::setUuidAttributes($model); // @codeCoverageIgnore
        });
    }

    /**
     * Sets uuid values for designated attributes.
     *
     * @param   UuidModel
     *
     * @return  void
     */
    public static function setUuidAttributes($model)
    {
        $attributes = array_merge($model->uuidAttributes, [$model->getKeyName()]);

        array_map(function ($attribute) use ($model) {
            $model->{$attribute} = (string) $model->generateNewId();
        }, $attributes);
    }

    /**
     * Get a new version 4 (random) UUID.
     *
     * @return \Rhumsaa\Uuid\Uuid
     */
    public function generateNewId()
    {
        return Uuid::uuid4();
    }
}
