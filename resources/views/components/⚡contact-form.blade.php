<div>
    @if ($success)
        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-6 text-center">
            <svg class="w-12 h-12 mx-auto text-green-500 mb-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-lg font-semibold text-green-800 dark:text-green-300 mb-2">¡Mensaje enviado!</h3>
            <p class="text-green-600 dark:text-green-400">Gracias por contactarnos. Te responderemos a la brevedad.</p>
        </div>
    @else
        <form wire:submit="submit" class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nombre *</label>
                    <input wire:model="name" id="name" type="text" class="block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    @error('name') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email *</label>
                    <input wire:model="email" id="email" type="email" class="block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    @error('email') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Teléfono</label>
                    <input wire:model="phone" id="phone" type="tel" class="block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    @error('phone') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Empresa</label>
                    <input wire:model="company" id="company" type="text" class="block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    @error('company') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Mensaje *</label>
                <textarea wire:model="message" id="message" rows="5" class="block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"></textarea>
                @error('message') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>
            <div>
                <button type="submit" class="w-full sm:w-auto px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium transition-colors shadow-lg shadow-blue-600/25 disabled:opacity-50 disabled:cursor-not-allowed" wire:loading.attr="disabled">
                    <span wire:loading.remove>Enviar mensaje</span>
                    <span wire:loading>Enviando...</span>
                </button>
            </div>
        </form>
    @endif
</div>
