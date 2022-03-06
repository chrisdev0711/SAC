<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Action;
class Returned extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['returned_on', 'returned_reason'];

    protected $searchableFields = ['*'];

    protected $table = 'returned';

    public function action()
    {
        return $this->morphOne(Action::class, 'actionable');
    }
}
