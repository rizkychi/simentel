<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $casts = [
        'dropdown' => 'boolean',
        'active' => 'boolean',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class, 'roles_id', 'id');
    }
}
