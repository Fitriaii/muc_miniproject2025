<?php

namespace App\Models\marketing;

use App\Models\activity\TimesheetModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ServiceusedModel extends Model
{
    use HasFactory;
    protected $connection = 'mysql_marketing';
    protected $table = 'serviceused'; // atau nama table yang sesuai

    protected $fillable = [
        'service_name',
        'status'
    ];


    public function getDurationAttribute()
    {
        if ($this->timesheets->isEmpty()) {
            return '-';
        }

        $totalMinutes = $this->timesheets->sum(function ($ts) {
            if ($ts->timestart && $ts->timefinish) {
                $start  = Carbon::parse($ts->timestart);
                $finish = Carbon::parse($ts->timefinish);
                return $finish->diffInMinutes($start);
            }
            return 0;
        });

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return sprintf('%02d:%02d', $hours, $minutes);
    }


    public function proposal()
    {
        return $this->belongsTo(ProposalModel::class, 'proposal_id', 'id');
    }

    public function timesheets()
    {
        return $this->hasMany(TimesheetModel::class, 'serviceused_id');
    }
}
