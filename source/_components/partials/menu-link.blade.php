<a {{ $attributes->merge([
        'class' => 'text-brand-secondary-100 flex py-2 hover:underline text-lg hover:text-brand-accent-200 underline-offset-8'
    ]) }}
    >
    {!! $slot !!}
</a>