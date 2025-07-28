---
pagination:
    collection: posts
    perPage: 4
---
@extends('_layouts.main')

@section('body')
    <section class="w-full grid grid-cols-12 gap-10 my-16">
        <section class="col-span-8">
            <header class="w-full flex flex-col gap-3">
                <h1 class="font-serif tracking-tight block px-5 md:px-0 mb-0 md:text-4xl leading-10 text-brand-secondary-100 font-semibold text-3xl">Latest from me</h1>
                <p class="font-normal leading-relaxed text-lg text-gray-700 mb-8 md:mb-4 px-5 md:px-0 md:max-w-4xl">
                    How step-by-step guides to tutorials,
                    articles in-depth pieces exploring concepts, ideas, and analyses articles,
                    personal reflections and updates journal,
                    Quick tips with short, insightful snippets, code examples and
                    Newsletter Archive</p>
            </header>

            <section class="grid md:grid-cols-2 w-full md:gap-x-10 gap-y-4 md:gap-y-10 md:mt-10 px-4 md:px-0">
                @isset($pagination)
                    @foreach ($pagination->items as $post)
                        @includeWhen($post->isFeatured(), '_components.post-preview-inline')
                    @endforeach
                @endisset
            </section>

            @if ($pagination->pages->count())
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
        <section class="col-span-4 border-1 border-brand-secondary-400 rounded bg-brand-secondary-600">
            <aside>

            </aside>
        </section>
    </section>
@stop
