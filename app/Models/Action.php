<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;

class Action extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'actionable_id',
        'actionable_type',
        'appliance_id',
        'actioned_by',
    ];

    protected $searchableFields = ['*'];

    public function appliance()
    {
        return $this->belongsTo(Appliance::class);
    }

    public function actionee()
    {
        return $this->belongsTo(User::class, 'actioned_by');
    }

    public function actionable()
    {
        return $this->morphTo();
    }

    // public function actionee()
    // {
    //     return User::find($this->actioned_by);
    // }
}
