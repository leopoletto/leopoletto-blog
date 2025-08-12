@extends('_layouts.main')

@section('body')
    <section class="w-full grid grid-cols-12 gap-10 py-16">
        <section class="col-span-12">
            <header class="px-6 md:px-0 flex flex-col gap-4">
                <h1 class="font-serif tracking-tight font-semibold text-brand-secondary-100 text-3xl md:text-4xl leading-snug">{{ $page->title }}</h1>
                <p class="text-lg text-gray-800 data-label:before:content-[attr(data-label)] before:font-serif before:text-brand-secondary-200 before:uppercase before:text-base  gap-2 leading-relaxed" data-label="Quick Summary:">
                    {{ $page->description  }}
                </p>
            </header>

            <section class="px-6 md:px-0 prose">
                @yield('content')
            </section>

            <section class="grid md:grid-cols-3 w-full md:gap-x-10 gap-y-4 md:gap-y-10 md:mt-10 px-4 md:px-0">
                @foreach ($page->posts($posts) as $post)
                    @includeWhen($post->isFeatured(), '_components.post-preview-inline')
                @endforeach
            </section>
        </section>
    </section>
@stop