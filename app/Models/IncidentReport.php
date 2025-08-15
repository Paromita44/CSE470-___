<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location',
        'incident_time',
        'description',
        'is_anonymous',
        'flagged',
        'status',
    ];

    /** 
     * Define the relationship to User model 
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Helper to display "Anonymous" if user is anonymous
    public function getReporterNameAttribute(): string
    {
        return $this->is_anonymous ? 'Anonymous' : ($this->user->name ?? 'No Name');
    }
}