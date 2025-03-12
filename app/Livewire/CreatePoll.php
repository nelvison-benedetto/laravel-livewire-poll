<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title = '';
    public $options = [''];
    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|array|min:1|max:10',
        'options.*'=>'required|min:1|max:255',  //each individual option must be...
    ];
    protected $messages = [
        'title.required' => 'The title is required.',
        'title.min' => 'The title must be at least 3 characters.',
        'options.*.required' => 'The option can\'t be empty.',
        'options.*.min' => 'Each option must have at least 1 character.',
    ];


    // public $count = 0;  //livewire quickstart
    // public function increment()
    // {
    //     $this->count++;
    // }

    public function render()
    {
        return view('livewire.create-poll');
    }
    public function addOption(){
        $this->options[] = '';
    }
    public function removeOption($index){
        unset($this->options[$index]);   //remove
        $this->options = array_values($this->options);  //reorder indexes
        if(empty($this->options)){  //at least 1 option with '' if options empty
            $this->options = [''];
        }
    }
    public function updated($propertyName){  //valid only target field not the entire form
        $this->validateOnly($propertyName);
    }

    public function createPoll(){
        $this->validate();  //validate all fields
        Poll::create([
            'title' => $this->title,
        ])->options()->createMany(
            collect($this->options)  //coellct() transforms arr into an obj Laravel Collection
                ->map(fn ($option)=>['name'=>$option])
                ->all()  //converts obj Laravel Collection in normal arr
        );
        $this->reset(['title','options']);  //resets fields
        $this->dispatch('pollCreated');  //laravel vs3+, sends event x update the list of poll in UI
    }

}
