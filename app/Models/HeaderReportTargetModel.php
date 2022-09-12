<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderReportTargetModel extends Model
{
    use HasFactory;

    protected $table = 'header_report_target';
    protected $fillable = ['dashboard_id', 'title', 'live'];
}
