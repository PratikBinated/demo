<?php

namespace App\Components;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Traits\Macroable;
use Livewire\Component;

class TextInput implements Htmlable
{
    use Macroable;

    protected string|\Closure $label;
    protected Component $livewire;
    protected null|\Closure |int $maxLength=null;
    protected static array $configurations=[];
    

    public function __construct(
        protected string $name
    ) 
    {
    }

    public static function make(string $name) : self
    {
        $input = new self($name); 
        // dd(self::$configurations);
        foreach (self::$configurations as $configuration) {
            $configuration($input);
        }

        return $input;
    }

    public function label(string|\Closure $label) : self
    {
        $this->label=$label;
        return $this;
    }

    public function livewire(Component $livewire) : self
    {
        $this->livewire=$livewire;
        return $this;
    }

    public function maxLength(int| \Closure | null $length) : self
    {
        $this->maxLength=$length;
        return $this;
    }

    public static function configureUsing(\Closure $configure) : void 
    {
        self::$configurations[]=$configure;
    }

    public function evalute($value)
    {
        if($value instanceof \Closure){
            return app()->call($value,[
                'state'=>$this->livewire->{$this->getName()},
                'random'=>Str::random(),
            ]);
        }
        return $value;
    }

    public function getLabel() : string
    {
        // dd($this->label);
        return $this->evalute($this->label ?? null) ?? str($this->getName())->title();
    }

    public function getMaxLength() : ?int    
    {
        return $this->maxLength;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function extractPublicMethods() : array
    {
        $reflection = new \ReflectionClass($this);
        $methods=[];
        foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            $methods[$method->getName()]=\Closure::fromCallable([$this,$method->getName()]);
            // $methods[$method->getName()]=$method->getName()(...);
        } 

        return $methods;
    }

    public function render() : View
    {
        return view('components.text-input',$this->extractPublicMethods());
    }
    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml(): string{
        return $this->render()->render();
    }
}