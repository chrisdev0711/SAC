<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Appliance;

class CheckIn extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'appliance_in_img',
        'data_badge_img',
        'serial_num',
        'condition',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'check_ins';

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

    public function location()
    {
        $action = $this->action;
        $appliance = null;
        if($action)
            $appliance = Appliance::find($action->appliance_id);

        return optional($appliance)->Location ?? '';
    }
}
