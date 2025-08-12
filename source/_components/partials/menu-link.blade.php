<a {{ $attributes->merge([
        'class' => 'text-brand-secondary-100 flex py-2 hover:underline text-lg hover:text-brand-secondary-300 underline-offset-8'
    ]) }}
    >
    {!! $slot !!}
</a>