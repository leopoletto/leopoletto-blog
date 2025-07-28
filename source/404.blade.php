@extends('_layouts.main')

@section('body')
    <div class="flex min-h-[calc(100vh-400px)] justify-center flex-col items-center text-brand-secondary-100 mt-10">
        <h1 class="text-[80px] font-mono leading-none mb-2 tracking-tight">404</h1>
        <h2 class="text-5xl tracking-tight">Page not found.</h2>

        <hr class="block w-full max-w-sm mx-auto border my-8">

        <p class="text-xl text-center leading-loose">
            The page you are looking for does not exist, or it is no longer available. <br>
            Go to the <a title="Home Page" href="/">Home Page</a>.
        </p>
    </div>
@endsection
