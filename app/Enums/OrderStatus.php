<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending   = 'pending';
    case Paid      = 'paid';
    case Shipped   = 'shipped';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Pending   => __('message.pending'),
            self::Paid      => __('message.paid'),
            self::Shipped   => __('message.shipped'),
            self::Completed => __('message.completed'),
            self::Cancelled => __('message.cancelled'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending   => 'warning',
            self::Paid      => 'info',
            self::Shipped   => 'primary',
            self::Completed => 'success',
            self::Cancelled => 'danger',
        };
    }
}
