<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    // One teacher can be adviser of many sections.
    // The column is adviser_id, not teacher_id, so we name it.
    public function advisorySections(): HasMany
    {
        return $this->hasMany(Section::class, 'adviser_id');
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function fullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
