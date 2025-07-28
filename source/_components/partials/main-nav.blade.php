@props([
    'github' => $github,
    'linkedin' => $linkedin,
    'x' => $x,
    'atom' => $atom,
    'links' => $links,
 ])
<nav class="mt-4 mb-0 flex items-center gap-5">
    <ul class="flex gap-5">
        <li>
            <a href="{{ $github }}"
               class="text-brand-secondary-100 hover:text-brand-accent-300">
                <x-icons.github class="h-5"/>
            </a>
        </li>
        <li>
            <a href="{{ $linkedin }}"
               class="text-brand-secondary-100 hover:text-brand-accent-300">
                <x-icons.linkedin class="h-5"/>
            </a>
        </li>
        <li>
            <a href="{{ $x }}">
                <x-icons.x
                        class="h-5 stroke-brand-secondary-100 hover:stroke-brand-accent-300 fill-brand-secondary-100 hover:fill-brand-accent-300"/>
            </a>
        </li>
        <li>
            <a href="{{ $atom }}" class="text-brand-secondary-600 hover:text-brand-accent-700">
                <x-icons.rss class="h-5 text-brand-secondary-100 hover:text-brand-accent-300"/>
            </a>
        </li>
    </ul>
    {{$links}}
</nav>