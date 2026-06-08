<?php

use function Filament\Support\generate_blade_styles;

?>

<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <div class="fi-form-actions">
            <div class="flex flex-row-reverse flex-wrap items-center gap-3">
                <x-filament::button type="submit">
                    Guardar configuración
                </x-filament::button>
            </div>
        </div>
    </x-filament-panels::form>
</x-filament-panels::page>
