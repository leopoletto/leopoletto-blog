<div class="flex flex-col bg-white md:border border-b border-gray-300 drop-shadow-sm  rounded-lg overflow-clip">
    <a href="{{ $post->getUrl() }}" title="Read more: {{ $post->title }}">
        <img src="{{ $page->baseUrl . '/assets/images/' . ($post?->cover ? 'cover/' . $post->cover : 'og/' . $post->image) }}"
             alt="{{ $post->title }}">
    </a>
    <div class="flex-grow gap-2 flex flex-col w-full">
        <div class="flex gap-5 justify-between border-b border-b-gray-300 px-6 py-4">
            <time datetime="{{ $post->getDate()->format('Y-m-d') }}" class="text-gray-700 font-mono">
                {{ $post->getDate()->format('F j, Y') }}
            </time>
            <ul class="flex gap-4">
                @if ($post->categories)
                    @foreach ($post->categories as $i => $category)
                        <li>
                            <a href="{{ '/categories/' . $category }}/"
                               title="View posts in {{ $category }}"
                               class="underline underline-offset-4 uppercase text-sm text-gray-700"
                            >{{ $category }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="flex gap-2 flex-col px-6 py-4">
            <h2 class="font-serif  flex mb-2 self-baseline text-2xl">
                <a href="{{ $post->getUrl() }}" title="Read more: {{ $post->title }}"
                   class=" text-brand-secondary-100 font-medium text-xl">{{ $post->title }}</a>
            </h2>
            <p class="text-gray-800 text-lg leading-relaxed mb-4">{{ $post->description }}</p>
        </div>
    </div>
</div>