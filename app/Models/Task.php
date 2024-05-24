<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'due_date', 'status', 'user_id'];
    //Each Task Assigned to one user(one-many)
    //The Task can be un assinged
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'id' => -1,
            'name' => 'Not Assigned',
        ]);
    }

    public function scopeFilter(Builder $query, $filters)
    {

        //Default Values
        $options = array_merge([
            'id' => null,
            'user_id' => null,
            'title' => null,
            'status' => '',
            'due_date' => null,
        ], $filters);

        $query->when($options['id'], function ($query, $value) {
            $query->where('id', '=', $value);
        });

        $query->when($options['user_id'], function ($query, $value) {
            $query->where('user_id', '=', $value);
        });

        $query->when($options['title'], function ($query, $value) {
            $query->where('title', 'LIKE', '%' . $value . '%');
        });

        $query->when($options['status'], function ($query, $value) {
            $query->where('status', '=', $value);
        });

        $query->when($options['due_date'], function ($query, $value) {
            $startDate = Carbon::parse($value)->startOfDay();
            $endDate = Carbon::parse($value)->endOfDay();
            $query->whereBetween('due_date', [$startDate, $endDate]);
        });

    }
}
