<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template2Model extends Model
{
    use HasFactory;

    protected $table = 'template2';
    protected $fillable = ['operating', 'early_production', 'extrud', 'send', 'before_send', 'before_production', 'disable', 'position'];
}
