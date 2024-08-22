<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    protected $fillable = ['client_name', 'client_phone', 'client_email', 'description',
    'assigned_to', 'status', 'created_by'];


    public function assignedOfficer()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }
}
