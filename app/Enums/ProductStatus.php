<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Product Status Enum
 * PHP 8.3 Feature: Typed class constants
 */
enum ProductStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case OUT_OF_STOCK = 'out_of_stock';

    // PHP 8.3: Typed class constant
    public const string DEFAULT_STATUS = 'active';
    public const int MAX_STOCK = 10000;
    public const float MIN_PRICE = 0.01;

    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::OUT_OF_STOCK => 'Out of Stock',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::ACTIVE => 'green',
            self::INACTIVE => 'gray',
            self::OUT_OF_STOCK => 'red',
        };
    }

    public static function fromString(string $status): self
    {
        return match($status) {
            'active' => self::ACTIVE,
            'inactive' => self::INACTIVE,
            'out_of_stock' => self::OUT_OF_STOCK,
            default => self::ACTIVE,
        };
    }
}
