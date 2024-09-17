<?php

namespace App\Livewire;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RolesTable extends Component
{
    protected $model = Role::class;

    protected string $tableName = 'roles';

    // for table header button
    public $showButtonOnHeader = true;

    public $buttonComponent = 'roles.components.add-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->setQueryStringStatus(false);

        $this->setThAttributes(function (Column $column) {
            if ($column->getField() === 'id') {
                return [
                    'style' => 'width:9%;text-align:center',
                ];
            }

            return [];
        });

        $this->setTdAttributes(function (Column $column) {
            if ($column->getField() === 'id') {
                return [
                    'class' => 'text-center',
                ];
            }
            if ($column->getField() === 'name') {
                return [
                    'class' => 'text-left customWidth',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('Role Name'), 'name')
                ->searchable()
                ->sortable(),

            Column::make(__('Created At'), 'created_at')
                ->sortable()
                ->format(function ($value, $row, Column $column) {
                    return $row->created_at->format('Y-m-d');
                }),

            Column::make(__('Action'), 'id')
                ->format(function ($value, $row, Column $column) {
                    return view('livewire.action-button')
                        ->with([
                            'editRoute' => route('roles.edit', $row->id),
                            'dataId' => $row->id,
                            'deleteClass' => 'role-delete-btn',
                        ]);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Role::with('permissions')->select('roles.*');
    }

    public function resetPageTable()
    {
        $this->customResetPage('rolesPage');
    }

    public function placeholder()
    {
        return view('livewire.listing_skeleton');
    }
}
