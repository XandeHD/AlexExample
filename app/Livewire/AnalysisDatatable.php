<?php

namespace App\Livewire;

use App\Models\Client;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\CallbackColumn;
use Illuminate\Contracts\Session\Session;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class AnalysisDatatable extends DataTableComponent
{
    protected $model = Client::class;

    protected $listeners = ['toggleApproved', 'toggleEstado'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setLoadingPlaceholderEnabled()
        ->setLoadingPlaceholderStatus(true)
        ->setLoadingPlaceholderContent(__('datatable.loading'))
        ->setEmptyMessage(__('datatable.no_results'));

        // Debug = true
        $this->setDebugEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->searchable(),
            Column::make(__('messages.name'), "name")
                ->sortable()->searchable(),
            Column::make(__('messages.approved'),"approved")
                ->label(fn ($row) => $this->renderApprovalButton($row))
                ->html()
                ->sortable(),
            Column::make(__('messages.status'),"status")
                ->label(fn ($row) => $this->renderStatusButton($row))
                ->html()
                 ->sortable(),
            Column::make(__('messages.approved_by'), "approved_by")
                ->sortable()
                ->collapseOnTablet(),
            Column::make(__('messages.approved_at'), "approved_at")
                ->sortable()
                ->collapseOnTablet()
                ->format(
                    fn($value, $row, Column $column) => date('d-m-Y H:i',strtotime($row->approved_at))
                ),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Estado')
                ->options([
                    '' => __('datatable.all'),
                    '1' => __('datatable.yes'),
                    '0' => __('datatable.no'),
                ])->filter(function(Builder $builder,$op){
                    if($op <> ''){
                        $builder->where('status',(int)($op));
                    }
                }),
            SelectFilter::make('Aprovado')
                ->options([
                    '' => __('datatable.all'),
                    '1' => __('datatable.yes'),
                    '0' => __('datatable.no'),
                ])->filter(function(Builder $builder,$op){
                    if($op <> ''){
                        $builder->where('approved',(int)($op));
                    }
                }),
        ];
    }

    public function toggleApproved($id)
    {
        $item = Client::find($id);
        if ($item) {
            $item->approved = !$item->approved;
            $item->approved_at = date('Y-m-d H:i');
            $item->approved_by = Auth::user()->name;
            $item->status = !$item->approved ? 0 : 1 ;
            $item->save();
        }
    }

    public function toggleEstado($id)
    {
        $item = Client::find($id);
        if ($item) {
            $item->status = !$item->status;
            $item->save();
        }
    }

    public function renderApprovalButton($row): string
    {
        return view('components.toggle-approved', compact('row'))->render();
    }

    public function renderStatusButton($row): string
    {
        return view('components.toggle-status', compact('row'))->render();
    }

    // Editar a query que é feita na base de dados
    public function builder(): Builder
    {
        return Client::select('*')
        ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => 
                $query->where('name', 'like', '%' . $name . '%')
            );
    }

    

}
