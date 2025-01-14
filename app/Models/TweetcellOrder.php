<?php

namespace App\Models;


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class TweetcellOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tweetcell_id',
      'player_no',
        'name',
        'count',
        'price',
        'note',
        'status'
    ];
    
    public function profits()
    {
        return $this->morphMany(Profit::class, 'profitable');
    }
}
