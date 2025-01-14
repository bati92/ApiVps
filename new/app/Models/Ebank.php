<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ebank extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_id',
        'name',
        'image',
        'image_url',
        'note',
        'price',
        'status',
    ];
   
    public function users(): BelongsToMany
    {
        return $this->BelongsToMany(User::class, 'ebank_orders', 'user_id',
        'ebank_id');
    }
    
    public function ebankSection(): BelongsTo
    {
        return $this->belongsTo(ebankSection::class, 'section_id');
    }
    public function orders()
{
    return $this->hasMany(EbankOrder::class, 'ebank_id');
}
}
