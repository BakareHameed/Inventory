<?php

namespace App\Models\ServiceOps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class POPTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignee_id', 'purpose', 'pop_id', 'contact_person', 'address', 'contact_phone', 'fault',
        'fault_details', 'fault_level', 'fault_type', 'first_engr_id', 'reassignee_id', 'prev_engr_id',
        'reassignment_reason', 'status', 'closed_by_uid', 'start_time', 'accepted_time', 'accepted_by',
        'end_time', 'duration', 'closing_remark', 'tickets_id', 'purpose', 'fault_owner'
    ];

    protected $table = 'pop_tickets';
    protected $primarKey = 'tickets_id';
    protected $keyType = 'string';
}
