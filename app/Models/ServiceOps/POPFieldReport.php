<?php

namespace App\Models\ServiceOps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POPFieldReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'engr_id', 'ticket_id', 'RCA', 'Resolution', 'cable_state', 'chain_balance', 'radio_state',
        'connector_state', 'cable_neg', 'signal', 'signal', 'additional', 'submitted_at',
    ];

    protected $table = 'pop_maintenance';
    // protected $primarKey = 'tickets_id';
    // protected $keyType = 'string';
}
