<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    protected $fillable = ['ticket','description','assigned_to', 'status', 'resolved_at', 'created_by', 'solution'];


    public function assignedOfficer()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function clientReported()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
