<?php

namespace App\Models;

use App\Traits\HasAuthor;
use App\Traits\HasHistories;
use App\Traits\Scopes\ScopeActive;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentClass extends Model
{
    use HasFactory, SoftDeletes, HasAuthor, HasHistories, ScopeActive;

    protected $guarded = [];

    public function department_class_subjects(): HasMany
    {
        return $this->hasMany(DepartmentClassSubject::class)
            ->orderBy('priority')
            ;
    }
}
