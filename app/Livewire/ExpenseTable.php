<?php

namespace App\Livewire;

use App\Models\Expense;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class ExpenseTable extends LivewireTableComponent
{
    protected $model = Expense::class;

    protected string $tableName = 'expenses';

    // for table header button
    public $showButtonOnHeader = true;

    public $buttonComponent = 'expense.components.add-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->setQueryStringStatus(false);

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if (in_array($column->getField(), ['name'])) {
                return [
                    'class' => 'w-75',
                ];
            }

            return [];
        });

        $this->setThAttributes(function (Column $column) {
            if ($column->getField() == 'id') {
                return [
                    'style' => 'width:9%;text-align:center',
                ];
            }

            return [
                'class' => 'text-center',
            ];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.expense.expense'), 'name')
                ->sortable()
                ->searchable(),

            Column::make(__('messages.common.action'), 'id')
                ->format(function ($value, $row, Column $column) {

                    $canEdit = auth()->user()->can('expense.edit');
                    $canDelete = auth()->user()->can('expense.destroy');
                    return view('livewire.modal-action-button')
                        ->with([
                            'dataId' => $row->id,
                            'editClass' => 'expense-edit-btn',
                            'canEdit' => $canEdit,
                            'canDelete' => $canDelete,
                            'deleteClass' => 'expense-delete-btn',
                        ]);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Expense::query();
    }

    public function resetPageTable()
    {
        $this->customResetPage('expensesPage');
    }

    public function placeholder()
    {
        return view('livewire.listing_skeleton');
    }
}
