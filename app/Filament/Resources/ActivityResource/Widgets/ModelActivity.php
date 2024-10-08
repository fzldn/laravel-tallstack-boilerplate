<?php

namespace App\Filament\Resources\ActivityResource\Widgets;

use App\Models\Activity;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Gate;

class ModelActivity extends BaseWidget
{
    public ?Model $record = null;
    public ?Model $causer = null;

    public static function canView(): bool
    {
        return Gate::check('viewAny', Activity::class);
    }

    public function getHeading(): ?string
    {
        if ($this->causer) {
            return __('User Activity');
        }

        return str(class_basename($this->record))
            ->headline()
            ->append(__(' History'));
    }

    public function table(Table $table): Table
    {
        $query = Activity::query()
            ->when(
                $this->causer,
                function ($q, $causer) {
                    $q->causedBy($causer);
                },
                function ($q) {
                    $q->forSubject($this->record);
                }
            );

        return $table
            ->heading($this->getHeading())
            ->query($query)
            ->columns([
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\TextColumn::make('description')->html(),
                    Tables\Columns\Layout\Split::make([
                        Tables\Columns\TextColumn::make('created_at')
                            ->since()
                            ->dateTimeTooltip()
                            ->badge()
                            ->color('warning')
                            ->grow(false),
                    ])
                        ->grow(false),
                ])
                    ->from('md'),
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\ViewColumn::make('properties')
                        ->view('filament.tables.columns.activity-properties'),
                ])
                    ->hidden(fn(Model $model) => (new $model->subject_type) instanceof Pivot)
                    ->extraAttributes(['class' => 'overflow-x-auto'])
                    ->collapsible(),
            ])
            ->paginationPageOptions([10, 25, 50, 100]);
    }
}
