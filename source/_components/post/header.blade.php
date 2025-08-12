@props([
    'page' => $page
])

<header class="flex flex-col gap-16 my-16">
    <div class="flex md:items-base flex-col gap-4 md:flex-row border-b pb-4 border-gray-300">
        <span class="flex">
            <span class="flex gap-8 items-base justify-center">
            @foreach($page->get('categories', []) as $category)
                <a href="{{ str($page->baseUrl)->append('categories/' . $category ) }}" title="View posts in {{ $category }}"
                   class="uppercase text-base font-mono text-brand-secondary-100  after:flex  after:content-['✦'] after:text-brand-secondary-200 after:text-xl last:after:content-[''] relative after:absolute after:-top-1 after:-right-6"
                >{{ $category }}</a>
            @endforeach
            </span>
        </span>
        <span class="flex uppercase gap-3 text-sm md:justify-between md:ml-auto pl-3 border-gray-300 items-center text-gray-600">
            <time datetime="{{ date('Y-m-d', $page->date) }}" class="mb-0 font-mono">{{ date('F j, Y', $page->date) }}</time>
            <span class="flex gap-2 font-mono items-center before:content-['✦'] before:text-brand-secondary-400 before:pr-1">
                {{ $page->getReadingTime()  }}
            </span>
        </span>
    </div>
    <div class="px-6 md:px-0 flex flex-col gap-5 ">
        <h1 class="font-serif  tracking-tight font-semibold text-brand-secondary-100 text-3xl md:text-4xl leading-snug">{{ $page->title }}</h1>
        <p class="text-xl font-light text-gray-800 data-label:before:content-[attr(data-label)] before:font-serif  before:text-brand-secondary-200 before:uppercase before:text-base before:font-semibold before:tracking-wider gap-2 leading-relaxed"
           data-label="Quick Summary: ">{{ $page->description  }}
        </p>
    </div>
</header>