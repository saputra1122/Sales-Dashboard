<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportTarget2Model extends Model
{
    use HasFactory;

    protected $table = 'report_target2';
    protected $fillable = ['h_report_target_id', 'operating', 'early_production', 'extrud', 'send', 'before_send', 'before_production', 'disable', 'position'];
}
