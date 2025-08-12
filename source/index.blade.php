---
pagination:
    collection: posts
    perPage: 12
---
@extends('_layouts.main')

@section('body')
    <section class="w-full grid grid-cols-12 max-w-3xl  gap-10 my-5">
        <section class="col-span-12">
            <header class="w-full flex flex-col gap-3">
                <h1 class="font-serif tracking-tight block md:px-0 mb-0 md:text-4xl leading-10 text-brand-secondary-300 font-semibold text-3xl">Latest updates</h1>
                <p class="text-lg w-full text-gray-800 data-label:before:content-[attr(data-label)] before:font-serif before:text-brand-secondary-200 before:uppercase before:text-base before:font-bold gap-2 leading-relaxed" data-label="Quick Summary:">
                    Step-by-step guides to tutorials; articles in-depth pieces exploring concepts, ideas, and analyses;
                    personal reflections and updates journal; quick tips with short, insightful snippets and code samples.
                </p>
            </header>

            <section class="w-full flex flex-col gap-y-10 px-4 md:px-0 mt-16">
                @isset($pagination)
                    @foreach ($pagination->items as $post)
                        @includeWhen($post->isFeatured(), '_components.post-preview-inline')
                    @endforeach
                @endisset
            </section>

            @if ($pagination->pages->count() > 1)
            <nav class="flex text-base my-16 justify-center">
                @if ($previous = $pagination->previous)
                    <a
                            href="{{ $previous }}"
                            title="Previous Page"
                            class="text-brand-primary-100 bg-white border min-w-12 text-center rounded mr-3 px-2 py-2"
                    >&LeftArrow;</a>
                @endif

                @foreach ($pagination->pages as $pageNumber => $path)
                    <a
                            href="{{ $path }}"
                            title="Go to Page {{ $pageNumber }}"
                            class=" rounded mr-3 px-2 py-2 min-w-12 text-center {{ $pagination->currentPage == $pageNumber ? 'bg-brand-primary-100 text-brand-accent-700' : 'text-brand-primary-100 bg-white border' }}"
                    >{{ $pageNumber }}</a>
                @endforeach

                @if ($next = $pagination->next)
                    <a
                            href="{{ $next }}"
                            title="Next Page"
                            class="text-brand-primary-100 min-w-12 text-center bg-white border rounded mr-3 px-2 py-2"
                    >&RightArrow;</a>
                @endif
            </nav>
            @endif
        </section>
    </section>
@stop
