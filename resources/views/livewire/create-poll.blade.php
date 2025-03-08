<div>
    <form>
        <label for="pollTitle">Poll Title</label>
        <input type="text" id="pollTitle" wire:model="title" />
        <p>Current title: {{ $title }}</p>
    </form>
</div>
