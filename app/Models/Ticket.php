<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\FieldSupport;

class Ticket extends Model
{
    use HasFactory;


    protected $fillable = [
        'assignee_id', 'client_id', 'client_name', 'client_email', 'client_phone', 'client_address',
        'fault', 'fault_details', 'fault_level', 'fault_type', 'first_engineer_id', 'closing_remark',
        'prev_engr_id', 'reassignment_reason', 'status', 'start_time', 'end_time', 'duration'
    ];

    protected $table = 'ticket';

    protected $primarKey = 'tickets_id';

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $id = Str::uuid();
                $model->id = $id;
                $field = new FieldSupport();
                $field->ticket_id = $id;;
                $field->save();
            }
        });
    }
}
