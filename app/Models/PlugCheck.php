<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Appliance;

class PlugCheck extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['pass_test', 'repair_type','insulation','gas','earth'];

    protected $searchableFields = ['*'];

    protected $table = 'plug_checks';

    protected $casts = [
        'pass_test' => 'boolean',
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
