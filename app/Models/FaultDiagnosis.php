<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Appliance;

class FaultDiagnosis extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'time_started',
        'time_finished',
        'fault_found',
        'parts_required',
        'repaired',
        'test_again',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'fault_diagnoses';

    protected $casts = [
        'time_started' => 'datetime',
        'time_finished' => 'datetime',
        'repaired' => 'boolean',
        'test_again' => 'boolean',
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
