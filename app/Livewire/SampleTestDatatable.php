<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SampleTests;
use Illuminate\Contracts\Session\Session;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class SampleTestDatatable extends DataTableComponent
{
    protected $model = SampleTests::class;

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
            Column::make(__('messages.description'), "description")
                ->sortable()->searchable()->format(fn ($value, $row) => $row->descriptionByLocale->description ?? $row->description),
            Column::make(__('messages.code'), "code")
                ->sortable()->searchable(),
            Column::make(__('messages.cost'), "cost")
                ->sortable(),
            Column::make(__('messages.status'), "status")
                ->sortable()
                ->unclickable(),
            // Column::make(__('messages.created_by'), "created_by")
            //     ->sortable()
            //     ->collapseOnTablet(),
            Column::make(__('messages.updated_by'), "updated_by")
                ->sortable()
                ->collapseOnTablet(),
            Column::make(__('messages.created_at'), "created_at")
                ->sortable()
                ->collapseOnTablet()
                ->format(
                    fn($value, $row, Column $column) => date('d-m-Y',strtotime($row->created_at))
                ),
            // Column::make(__('messages.updated_at'), "updated_at")
            //     ->sortable()
            //     ->collapseOnTablet()
            //     ->format(
            //         fn($value, $row, Column $column) => date('d-m-Y H:i',$row->created_at)
            //     ),
            LinkColumn::make('')
                ->title(fn ($row) => view('components.icons.edit')->render())
                ->location(fn ($row) => route('admin-sample-form',[$row['id']]))
                ->html()
                ->excludeFromColumnSelect(),
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
        ];
    }

    // Editar a query que é feita na base de dados
    public function builder(): Builder
    {
        return SampleTests::with('descriptionByLocale')
            ->when($this->columnSearch['name'] ?? null, function ($query, $name) {
                $locale = session('locale');

                $query->where(function ($q) use ($name, $locale) {
                    $q->whereHas('descriptionByLocale', function ($q2) use ($name) {
                        $q2->where('description', 'like', "%{$name}%");
                    })
                    ->orWhere('description', 'like', "%{$name}%"); // fallback
                });
            })
            ->when($this->columnSearch['email'] ?? null, fn ($query, $email) => 
                $query->where('id', 'like', '%' . $email . '%')
            );
    }

    

}
