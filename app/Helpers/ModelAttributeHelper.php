<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ModelAttributeHelper
{
    private const EXCLUDED_KEYS = ['id', 'user_id', 'created_at', 'updated_at'];

    /**
     * Merge source model attributes into target model, excluding metadata columns.
     */
    public static function mergeModelAttributes(Model $target, ?Model $source): void
    {
        if (!$source) {
            return;
        }

        foreach (self::safeAttributes($source) as $key => $value) {
            $target->setAttribute($key, $value);
        }
    }

    /**
     * Merge collection attributes into target model as grouped arrays (by attribute key).
     */
    public static function mergeGroupedCollectionAttributes(Model $target, ?EloquentCollection $collection): void
    {
        if (!$collection || $collection->isEmpty()) {
            return;
        }

        $grouped = [];

        foreach ($collection as $item) {
            foreach (self::safeAttributes($item) as $key => $value) {
                $grouped[$key][] = $value;
            }
        }

        foreach ($grouped as $key => $values) {
            $target->setAttribute($key, $values);
        }
    }

    /**
     * Remove metadata keys before flattening related model attributes.
     */
    private static function safeAttributes(Model $model): array
    {
        return Arr::except($model->getAttributes(), self::EXCLUDED_KEYS);
    }
}
