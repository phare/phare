<?php

namespace Stub\Domain\Bookings\Models;

use Stub\Domain\Bookings\Observers\BookingObserver;
use Stub\Domain\Clients\Models\Client;
use Stub\Domain\Units\Models\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stub\Support\Period;

class Booking extends Model
{
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        self::observe(BookingObserver::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function getPeriodAttribute(): Period
    {
        return Period::make($this->starts_at, $this->ends_at);
    }
}
