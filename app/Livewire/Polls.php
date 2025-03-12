<?php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Poll;
use Livewire\Component;

class Polls extends Component
{
    protected $listeners = [
        'pollCreated' => 'render',  //reload component after pollCreated
    ];
    public function render()
    {
        $polls = Poll::with('options.votes')  //load all Polls with their all options with their all votes
            ->latest()->get();   //order start from latest and get() return the collection of Poll objs
        return view('livewire.polls', ['polls'=>$polls]); //pass data ar associative arr key-value
    }
    public function vote(Option $option){  //when clicked vote($option) lrv uses dependency injection to find theright option id
        //$option = Option::findOrFail($optionId);
        $option->votes()->create();  //creates new vote
    }
}
