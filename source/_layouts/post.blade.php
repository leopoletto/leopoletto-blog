@extends('_layouts.main')

@section('body')
    <article class="container mx-auto w-full max-w-7xl my-5 md:my-16" id="read">
        <div class="max-w-5xl mx-auto">
            <section class="w-full">
                <x-post.header :page="$page"/>

                @if($page->cover)
                    <picture>
                        <img src="/assets/images/posts/{{$page->cover}}" class="w-full max-w-5xl mx-auto rounded"
                             alt=""/>
                    </picture>
                @endif

                <section class="mt-10 max-w-4xl mx-auto mb-8 px-6 md:px-0 prose">
                    @yield('content')
                </section>
            </section>
        </div>
    </article>
@endsection
