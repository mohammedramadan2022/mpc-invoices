<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniqueWithClient implements ValidationRule
{
    private $table;
    private $column1;
    private $column2;

    public function __construct($table, $column1, $column2, $ignoreId = null)
    {
        $this->table = $table;
        $this->column1 = $column1;
        $this->column2 = $column2;
        $this->ignoreId = $ignoreId;

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = DB::table($this->table)
            ->where($this->column1, $value)
            ->where($this->column2, request()->client_id);


        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }

        if ($query->count() > 0) {
            $fail(trans('validation.unique_two_columns', [
                'attribute' => $attribute,
            ]));
        }
    }

}
