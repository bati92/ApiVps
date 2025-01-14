<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
class TweetcellKontorOrder extends Model
{
   
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tweetcell_kontor_id',
        'mobile',
        'price',
        'note',
        'status'
    ];
    
    public function profits()
    {
        return $this->morphMany(Profit::class, 'profitable');
    }
}
