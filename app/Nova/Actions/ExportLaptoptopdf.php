// app/Nova/Actions/ExportLaptopsToPdf.php

namespace App\Nova\Actions;
<?php
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Support\Collection;
use PDF; // Ensure the alias is correctly imported
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\ActionResponse;

class ExportLaptopsToPdf extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $laptops = $models->map(function ($laptop) {
            return [
                'ID' => $laptop->id,
                'Name' => $laptop->name,
                'Manufacturer' => $laptop->manufacturer->name,
                'Price' => $laptop->price,
            ];
        });

        $pdf = PDF::loadView('pdf.laptops', ['laptops' => $laptops]);
        $filename = 'laptops-' . now()->timestamp . '.pdf';
        Storage::put('public/pdfs/' . $filename, $pdf->output());

        $url = Storage::url('public/pdfs/' . $filename);

        return ActionResponse
        