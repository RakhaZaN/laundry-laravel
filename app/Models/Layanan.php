<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function PHPUnit\Framework\isNull;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    protected $guarded = ['id'];

    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'layanan_id', 'id');
    }

    protected function gambar(): Attribute
    {
        return Attribute::get(
            fn (?string $value) => trim($value) == '' ? asset('assets/img/icon/services-icon1.svg') : asset('storage/' . $value)
        );
    }
}
