<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataCommunicationSection extends Model
{
    protected $fillable = [
        'name',
        'image',
        'image_url',
        'status',
    ];
    
    public function dataCommunications(): HasMany
    {
        return $this->hasMany(DataCommunication::class, 'section_id');
    }
  

}
