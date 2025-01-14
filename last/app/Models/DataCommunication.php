<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DataCommunication extends Model
{
    use HasFactory;
    protected $fillable = [
          'id',
        'name',
        'price',
        'amount',
        'basic_price',
        'image',
        'player_no',
        'image_url',
        'note',
        'status',
        'section_id',
    ];
  
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'data_communication_orders', 'data_communication_id',
        'user_id');
    }
    public function dataCommunicationSection(): BelongsTo
    {
        return $this->belongsTo(DataCommunicationSection::class, 'section_id');
    }
    public function orders()
{
    return $this->hasMany(DataCommunicationOrder::class, 'data_communication_id');
}
 
}
 