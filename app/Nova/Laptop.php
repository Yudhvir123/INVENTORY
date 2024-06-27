<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\ExportLaptoptopdf;
use App\Nova\Filters\UidFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

class Laptop extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Laptop>
     */
    public static $model = \App\Models\Laptop::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'uid';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'uid','sr_number',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable()
            ->hideFromIndex(),
            Text::make('Serial Number','sr_number')
            ->hideFromIndex(),

            Text::make('UID', function () {
                return $this->uid; // Access the computed attribute
            })->filterable()->exceptOnForms(),



            Text::make('Asset Type','asset_type')
                ->hideFromIndex()
                ->nullable()
                ->withmeta([
                    'value' => 'LPT',
                ]),


            BelongsTo::make('Manufacturer','manufacturer')
                ->sortable()
                ->display('name'),


            BelongsTo::make('Processor','processor')
                ->sortable()
                ->display('details'),


            Text::make('Model','model'),
            Select::make('RAM','ram')
                ->options([
                    '4GB'=>'4GB',
                    '8GB'=>'8GB',
                    '16GB'=>'16GB',
                    '32GB'=>'32GB',
                ]),


            Select::make('Memory Type')
                ->options([
                    'HDD'=>'HDD',
                    'SSD'=>'SSD',
                ]),

            Text::make('Memory Size','memory_size'),
            Select::make('Operating System','operating_system')
                ->options([
                    'WINDOWS 7'=>'WINDOWS 7',
                    'WINDOWS 8'=>'WINDOWS 8',
                    'WINDOWS 10'=>'WINDOWS 10',
                    'WINDOWS 11'=>'WINDOWS 11',
                ]),
            Text::make('Remarks','remarks'),
        ];


    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            //
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */

}
