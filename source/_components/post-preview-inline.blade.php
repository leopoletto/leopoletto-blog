<div class="flex flex-col bg-white">
    <div class="flex-grow gap-2 flex flex-col w-full">
        <div class="flex gap-2">
            <ul class="flex gap-4">
                @if ($post->categories)
                    @foreach ($post->categories as $i => $category)
                        <li>
                            <a href="{{ rtrim($post->getUrl(), '/') }}"
                               title="View posts in {{ $category }}"
                               class="capitalize text-lg font-serif text-brand-secondary-300 underline underline-offset-4"
                            >{{ $category }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <span>-</span>
            <time datetime="{{ $post->getDate()->format('Y-m-d') }}" class="text-gray-700 font-serif text-lg">
                {{ $post->getDate()->format('F j, Y') }}
            </time>
        </div>
        <div class="flex gap-2 flex-col py-4">
            <h2 class="font-serif flex mb-2 self-baseline text-2xl">
                <a href="{{ rtrim($post->getUrl(), '/') }}" title="Read more: {{ $post->title }}"
                   class=" text-brand-secondary-100 text-2xl">{{ $post->title }}</a>
            </h2>
            <p class="text-gray-800 text-[17px] leading-loose mb-4">{{ $post->description }}</p>
        </div>
    </div>
</div>