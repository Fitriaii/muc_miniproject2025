<?php

namespace App\Models\activity;

use App\Models\hrd\EmployeesModel;
use App\Models\marketing\ProposalModel;
use App\Models\marketing\ServiceusedModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesheetModel extends Model
{
    use HasFactory;

    protected $connection = 'mysql_activity';
    protected $table = 'timesheet'; // atau nama table yang sesuai

    public function employee()
    {
        return $this->belongsTo(EmployeesModel::class, 'employee_id');
    }

    public function serviceused()
    {
        return $this->belongsTo(ServiceusedModel::class, 'serviceused_id');
    }
}
