<div>
    <form wire:submit.prevent="createPoll" >
        <label for="pollTitle">Poll Title</label>
        <input type="text" id="pollTitle" wire:model="title" /> {{--link to $title of livewire component, continuosly update if this input changes--}}
        @error('title')
            <div class='text-red-500'>{{$message}}</div>  {{--if lrv intercepts a field error, provides a $message var with the error text--}}
        @enderror

        <div class="mb-4 mt-4">
            <button class="btn" wire:click.prevent="addOption">Add Option</button>
        </div>

        <div class="">
            @foreach ($options as $index => $option)
                <div class="mb-2">
                    {{-- {{$index}} - {{$option}} --}}
                    <label>Option {{$index + 1}}</label>
                    <div class="flex gap-2">
                        <input type="text" wire:model="options.{{$index}}">

                        <button class="btn" wire:click.prevent="removeOption({{$index}})">Remove</button>
                    </div>
                    @error('options.'.$index)
                        <div class='text-red-500'>{{$message}}</div>
                    @enderror
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn" >Create Poll</button>
    </form>

    {{-- <button wire:click="increment">+</button> livewire quickstart
    <h1>{{ $count }}</h1> --}}
</div>
