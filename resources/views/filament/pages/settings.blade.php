<?php

use function Filament\Support\generate_blade_styles;

?>

<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}

        <div class="fi-form-actions">
            <x-filament::button type="submit">
                Guardar configuración
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
