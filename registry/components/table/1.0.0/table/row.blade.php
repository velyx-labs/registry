<tr data-slot="table-row" {{ $attributes->merge(['class' => 'hover:bg-muted/50 border-b transition-colors data-[state=selected]:bg-muted']) }}>
    {{ $slot }}
</tr>