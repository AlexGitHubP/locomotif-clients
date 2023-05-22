<?php

namespace Locomotif\Clients\Models;

use Illuminate\Database\Eloquent\Model;
use Locomotif\Admin\Models\User;

class Clients extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
