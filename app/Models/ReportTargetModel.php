<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportTargetModel extends Model
{
    use HasFactory;

    protected $table = 'report_target';
    protected $fillable = ['h_report_target_id', 'operating', 'target', 'value', 'indicator', 'target_ar', 'value_ar', 'indicator_ar', 'disable', 'position'];
}
