@if (filled($brand = config('filament.brand')))
    <div @class([
        'filament-brand text-xl font-bold tracking-tight',
        'dark:text-white' => config('filament.dark_mode'),
    ])>

    <div><img src="{{ asset('/images/logo-twitter.png') }}" alt="Logo" class="h-10"></div>
        {{-- {{ $brand }} --}}
    </div>
@endif
