<?php

namespace App\Models\Supper_Admin\Sponsor;

use App\Models\Admin\HRM\Employee;
use App\Models\Admin\MyOffice\Department;
use App\Models\Admin\People\Agent;
use App\Models\Admin\People\Delegate;
use App\Models\Supper_Admin\Location\Currency;
use Illuminate\Database\Eloquent\Model;

class ManageSponsor extends Model
{
    protected $fillable =
        [
            'sponsor_type',
            'agent_id',
            'delegate_id',
            'sponsor_name',
            'cell_number',
            'email',
            'opening_balance',
            'nid',
            'sponsor_photo',
            'address',
            'employee_id',
            'note'
        ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function delegate()
    {
        return $this->belongsTo(Delegate::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
