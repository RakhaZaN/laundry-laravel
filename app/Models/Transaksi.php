<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $guarded = ['id'];

    public function buktiPath(): Attribute
    {
        return Attribute::get(
            fn (?string $value) => trim($value) == '' ? null : asset('storage/' . $value),
        );
    }
}
