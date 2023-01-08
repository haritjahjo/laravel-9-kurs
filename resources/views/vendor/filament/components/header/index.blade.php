@props([
    'actions' => null,
    'heading',
    'subheading' => null
])

<header {{ $attributes->class(['filament-header space-y-2 items-start justify-between sm:flex sm:space-y-0 sm:space-x-4  sm:rtl:space-x-reverse sm:py-4']) }}>
    <div>
        <x-filament::header.heading>
        
        <div class="flex"> 
            <div><img class="border mr-2 w-20" src="/logo.jpg" alt="Logo" style="width: 4.5rem;"></div>
            <div>{{ $heading }}</div>
        </div>
        
        
        </x-filament::header.heading>

        @if ($subheading)
            <x-filament::header.subheading class="mt-1">
                {{ $subheading }}
            </x-filament::header.subheading>
        @endif
    </div>


    <x-filament::pages.actions :actions="$actions" class="shrink-0" />
</header>
