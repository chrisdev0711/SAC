<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Appliance;

class Cleaning extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'time_started',
        'time_finished',
        'inside_before_img',
        'outside_before_img',
        'inside_after_img',
        'outside_after_img',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'time_started' => 'datetime',
        'time_finished' => 'datetime',
    ];

    public function action()
    {
        return $this->morphOne(Action::class, 'actionable');
    }

    public function sacNo()
    {
        $action = $this->action;
        $appliance = null;
        if($action)
            $appliance = Appliance::find($action->appliance_id);

        return optional($appliance)->SACNo ?? '-';
    }
}
