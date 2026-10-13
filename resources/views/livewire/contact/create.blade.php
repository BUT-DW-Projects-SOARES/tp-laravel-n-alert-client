<div>
    <form wire:submit="create">
        <p>
            <input class="border" placeholder="last name" wire:model="lastname">
            <x-form.validation-error value="lastname"/>
        </p>
        <p>
            <input class="border" placeholder="first name" wire:model="firstname">
            <x-form.validation-error value="firstname"/>
        </p>
        <p>
            <input class="border" placeholder="email" wire:model="email">
            <x-form.validation-error value="email"/>
        </p>
        <p><button type="submit">create</button></p>
    </form>
</div>
