<?php

namespace App\Livewire;

use Livewire\Component;
use App\Components\TextInput;

class TestForm extends Component
{
    public $email;
    public function render()
    {
        //Macro define on class
        // TextInput::macro('foo',function(){
        //     dd('bar');
        //     return 'bar';
        // });

        TextInput::configureUsing(function($input){
            $input->maxLength(5);
        });

        $nameInput = TextInput::make('name')
        ->label('Name')
        ->livewire($this);
    
        $emailInput = TextInput::make('email')
        ->label('Email')
        ->livewire($this);
    
        return view('livewire.test-form',[
            'nameInput' => $nameInput,
            'emailInput' => $emailInput,
            
        ]);
    }
}
