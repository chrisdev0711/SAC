<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Appliance;

class QualityControl extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'condition',
        'parts_burners',
        'parts_pan_supports',
        'parts_grill_tray',
        'parts_oven_shelves',
        'parts_oven_rails',
        'parts_door_glass',
        'parts_fridge_shelves',
        'cosmetic_marks',
        'cosmetic_mark_1_img',
        'cosmetic_mark_2_img',
        'cosmetic_mark_3_img',
        'cosmetic_mark_4_img',
        'cosmetic_mark_5_img',
        'cosmetic_mark_6_img',
        'cosmetic_mark_7_img',
        'cosmetic_mark_8_img',
        'cosmetic_mark_9_img',
        'cosmetic_mark_10_img',
        'cosmetic_mark_11_img',
        'cosmetic_mark_12_img',
        'cosmetic_mark_13_img',
        'cosmetic_mark_14_img',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'quality_controls';

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
