<?php

namespace App\Livewire;

use App\Forms\Components\ColorPicker;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class DemoForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('colors')
                ->description('Pick Your Color Schema For App!')
                ->icon('heroicon-o-swatch')
                ->schema([
                    ColorPicker::make('color-picker-1')
                    ->default('#00ff00')
                    ->width(100),
                    ColorPicker::make('color-picker-2')
                    ->default('#edff00')
                    ->width(100), 
                    ColorPicker::make('color-picker-3')
                    ->default('#edff00')
                    ->width(100),
                    ColorPicker::make('color-picker-4')
                    ->default('#edff00')
                    ->width(100),
                    ColorPicker::make('color-picker-5')
                    ->default('#edff00')
                    ->width(100),
                    ColorPicker::make('color-picker-6')
                    ->default('#edff00')
                    ->width(100),
                ])
            ])
            ->columns(3);
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        //
    }

    public function render(): View
    {
        return view('livewire.demo-form');
    }
}