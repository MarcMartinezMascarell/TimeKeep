<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'full_name',
        'logo',
        'user_id',
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'company_user', 'company_id', 'user_id')->withPivot('role');
    }
}
