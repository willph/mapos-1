<?php

namespace App\Models;

use App\Events\CustomerCreatedEvent;
use App\Events\CustomerDeletedEvent;
use App\Events\CustomerUpdatedEvent;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'document_number',
        'phone_number',
        'mobile_phone_number',
        'email',
        'postal_code',
        'street_number',
        'street_name',
        'neighborhood',
        'city',
        'state',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * The events that the model fires.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => CustomerCreatedEvent::class,
        'updated' => CustomerUpdatedEvent::class,
        'deleted' => CustomerDeletedEvent::class,
    ];
}
