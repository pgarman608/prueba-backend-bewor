<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;

class Company extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * 
     * He añadido al modelo los nuevos campos email, address y status
     * para poder acceder ha los campos de la tabla desde laravel.
     * 
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'status',
        'email',
        'address',
    ];
    /**
     * Convertir el modelo a un array asociativo
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $array = [
            'id'      => $this->id,
            'name'    => $this->name,
            'email'   => $this->email,
            'address' => $this->address,
            'status'  => $this->status_name
        ];

        return $array;
    }
}
