<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtpVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'otp',
        'attempts',
        'verified_at',
        'expires_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /**
     * Get the user associated with this OTP verification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if OTP is valid (not expired and not verified yet).
     */
    public function isValid(): bool
    {
        return $this->verified_at === null && $this->expires_at->isFuture();
    }

    /**
     * Check if OTP is expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Mark OTP as verified.
     */
    public function verify(): void
    {
        $this->update(['verified_at' => now()]);
    }

    /**
     * Increment attempts and check if max attempts exceeded.
     */
    public function incrementAttempts(): bool
    {
        $this->increment('attempts');
        return $this->attempts >= 5;
    }
}
