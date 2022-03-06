<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\CheckIn;
use App\Models\Cleaning;
use App\Models\QualityControl;

class Appliance extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'SACNo',
        'Status',
        'ModelNumber',
        'Description',
        'Supplier',
        'purchase_date',
        'CostExVat',
        'VAT',
        'CostIncVAT',
        'PONumber',
        'OtherRef',
        'SerialNum',
        'Grade',
        'Location',
        'returned_on',
        'returned_reason'
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['id'];

    protected $casts = [
        'purchase_date' => 'date',
    ];

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function photos()
    {
        $actions = $this->actions;

        $checkIn = null;
        $cleaning = null;
        $qc = null;
        foreach($actions as $action)
        {
            if(stripos($action->actionable_type, 'CheckIn') !== false)
                $checkIn = CheckIn::find($action->actionable_id);
            if(stripos($action->actionable_type, 'Cleaning') !== false)
                $cleaning = Cleaning::find($action->actionable_id);
            if(stripos($action->actionable_type, 'QualityControl') !== false)
                $qc = QualityControl::find($action->actionable_id);
        }

        if($checkIn)
            if(!$checkIn->appliance_in_img && !$checkIn->data_badge_img)
                $checkIn = null;
            
        if($cleaning)
            if(!$cleaning->inside_before_img && !$cleaning->outside_before_img && !$cleaning->inside_after_img && !$cleaning->outside_after_img)
                $cleaning = null;
        if($qc)
            if(!$qc->cosmetic_mark_1_img && !$qc->cosmetic_mark_2_img && !$qc->cosmetic_mark_3_img && !$qc->cosmetic_mark_4_img && !$qc->cosmetic_mark_5_img && !$qc->cosmetic_mark_6_img && !$qc->cosmetic_mark_7_img && !$qc->cosmetic_mark_8_img && !$qc->cosmetic_mark_9_img && !$qc->cosmetic_mark_10_img && !$qc->cosmetic_mark_11_img && !$qc->cosmetic_mark_12_img && !$qc->cosmetic_mark_13_img && !$qc->cosmetic_mark_14_img)
                $qc = null;

        return compact('checkIn', 'cleaning', 'qc');
    }

    public function actionsByType($type)
    {
        $result = null;
        $actions = $this->actions;
        foreach($actions as $action)
        {
            if($type == 'FaultDiagnosis')
                if(stripos($action->actionable_type, $type) !== false)
                {
                    $result = $action;
                    break;
                }
            if($type == 'Cleaning')
                if(stripos($action->actionable_type, $type) !== false)
                {
                    $result = $action;
                    break;
                }
        }
        
        return $result;
    }
}
