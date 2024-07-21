<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    public function Gudang()
    {
        return $this->belongsTo(Gudang::class, 'gudang_id', 'id');
    }
    public function Machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id', 'id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
