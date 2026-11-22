<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'user_id',
        'member_id',
        'borrowing_date',
        'due_date',
        'return_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'borrowing_date' => 'date',
            'due_date'       => 'date',
            'return_date'    => 'date',
        ];
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(BorrowingDetail::class);
    }

    // Masih dipinjam dan sudah melewati tanggal jatuh tempo
    public function isOverdue(): bool
    {
        return $this->status === 'borrowed' && $this->due_date->lt(today());
    }
}