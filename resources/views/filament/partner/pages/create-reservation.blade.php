<x-filament::page>
    <form wire:submit="create">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-4">
            Create Reservation
        </x-filament::button>
    </form>
</x-filament::page>
