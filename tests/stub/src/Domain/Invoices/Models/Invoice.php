<?php

namespace Stub\Domain\Invoices\Models;

use Stub\Domain\Clients\Models\Client;
use Stub\Domain\Invoices\Events\InvoiceSavingEvent;
use Stub\Domain\Invoices\QueryBuilders\InvoiceQueryBuilder;
use Stub\Domain\Invoices\States\Cancelled;
use Stub\Domain\Invoices\States\InvoiceState;
use Stub\Domain\Invoices\States\Overdue;
use Stub\Domain\Invoices\States\Paid;
use Stub\Domain\Invoices\States\Pending;
use Stub\Domain\Payments\Payable;
use Stub\Domain\Pdfs\ToPdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\ModelStates\HasStates;

/**
 * @property-read InvoiceState status
 */
class Invoice extends Model implements Payable, ToPdf
{
    use HasStates;

    protected $casts = [
        'total_price' => 'integer',
    ];

    protected $dispatchesEvents = [
        'saving' => InvoiceSavingEvent::class,
    ];

    public function newEloquentBuilder($query): InvoiceQueryBuilder
    {
        return new InvoiceQueryBuilder($query);
    }

    public function invoiceLines(): HasMany
    {
        return $this->hasMany(InvoiceLine::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getTotalPrice(): int
    {
        return $this->total_price;
    }

    public function getColour(): string
    {
        return $this->getState()->getColour();
    }

    public function getState(): InvoiceState
    {
        if ($this->status === 'overdue') {
            return new Overdue($this);
        }

        if ($this->status === 'paid') {
            return new Paid($this);
        }

        if ($this->status === 'cancelled') {
            return new Cancelled($this);
        }

        return new Pending($this);
    }

    protected function registerStates(): void
    {
        $this->addState('status', InvoiceState::class)
            ->allowTransition(Pending::class, Paid::class)
            ->allowTransition(Pending::class, Cancelled::class)
            ->allowTransition(Pending::class, Overdue::class)
            ->allowTransition(Overdue::class, Paid::class)
            ->allowTransition(Overdue::class, Cancelled::class);
    }
}
