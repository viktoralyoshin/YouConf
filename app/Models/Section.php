<?php

namespace App\Models;

use App\Enums\SectionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'description',
        'full_description',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'status' => SectionStatus::class,
    ];

    public function canRegistration(): bool
    {
        return $this->status === SectionStatus::REGISTRATION;
    }

    public function canCreateThesis(): bool {
        return $this->status === SectionStatus::ONGOING;
    }

    public function hasParticipant(?User $user): bool
    {
        if (!$user) return false;
        return $this->users()->where('user_id', $user->id)->exists();
    }

    public function theses()
    {
        return $this->hasMany(Thesis::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
