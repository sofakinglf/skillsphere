<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterWork extends Model
{
    use HasFactory;
    protected $table = 'work';
    protected $with = ['skills'];
    protected $guarded = [];

    public function instrunction()
    {
        return $this->hasMany(WorkInstruction::class, 'id', 'work_id');
    }

    public function skills()
    {
        return $this->hasMany(WorkSkills::class, 'work_id', 'id');
    }
    public function appliedUsers()
    {
        return $this->hasMany(AppliedWork::class, 'work_id', 'id');
    }
}
