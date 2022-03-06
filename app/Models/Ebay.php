<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebay extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['complete', 'note'];

    protected $searchableFields = ['*'];

    protected $table = 'ebays';

    protected $casts = [
        'complete' => 'boolean',
    ];

    public function action()
    {
        return $this->morphOne(Action::class, 'actionable');
    }

}
