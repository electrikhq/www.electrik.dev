@extends('layouts.www')

@section('head')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "TechArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ request()->url() }}"
  },
  "headline": "{{ $title }}",
  "description": "{{ $description }}",
  "url": "{{ request()->url() }}",
  "datePublished": "{{ $lastModifiedDate }}",  // Replace with actual publication date if available
  "dateModified": "{{ $lastModifiedDate }}",
  "publisher": {
    "@type": "Organization",
    "name": "Electrik"
  },
  "proficiencyLevel": "Intermediate",  // Example additional property
  "dependencies": ["Laravel", "TailwindCSS", "Electrik"],  // Example additional property
  "programmingLanguage": {
    "@type": "ComputerLanguage",
    "name": "PHP"
  }
}
</script>


@endsection

@section('content')
    <div class="grid grid-cols-12 gap-12">
        <!-- Main Content Area -->
        <div class="col-span-9 py-12">
            @include('components.breadcrumbs', ['project' => $project, 'version' => $version, 'slug' => $slug])

            <div class="prose dark:prose-invert !max-w-none prose-headings:underline prose:no-underline mt-6" style="text-decoration: none !important;">
                @if(isset($html))
                {!! $html !!}
                @else
                @yield('content')
                @endif
            </div>
            <div class="prose dark:prose-invert !max-w-none text-right mt-12 text-sm text-neutral-600">
                <span class="inline-flex items-center content-right space-x-2" title="{{ $lastModifiedDate->toIso8601String() }}">
                    <x-slate::icon icon="carbon-time" size="xs" /> <span>Last updated on {{ $lastModifiedDate->diffForHumans() }}</span>
                </span>
            </div>
            <hr class="my-6" />
            <div class="mt-8 flex justify-between">
                @if ($previousPage)
                <x-slate::button href="{{ $previousPage['link'] }}" class="mr-auto" icon="carbon-arrow-left" icon-position="before">
                    {{ $previousPage['title'] }}
                </x-slate::button>
                @endif

                @if ($nextPage)
                <x-slate::button href="{{ $nextPage['link'] }}" class="ml-auto" icon="carbon-arrow-right" icon-position="after">
                    {{ $nextPage['title'] }}
                </x-slate::button>
                @endif
            </div>
        </div>

        <!-- Right Sidebar (On This Page) -->
        <div class="col-span-3 py-12">
            <h4 class="font-bold mb-2 text-black">On this page</h4>
            <ul class="space-y-1 text-sm">
                @foreach ($headings as $heading)
                {{-- ml-2 ml-4 ml-6 --}}
                <li class="ml-{{ $heading['level'] == 'h3' ? '6' : '2' }}">
                    <a href="#{{ $heading['id'] }}" class="text-neutral-600 hover:underline dark:text-neutral-300">
                        {{ $heading['text'] }}
                    </a>
                </li>
                @endforeach
            </ul>
            <hr class="mt-12"/>
            <div class="mt-6">
                <x-slate::button
                    size="sm"
                    color="white" 
                    icon="carbon-arrow-right"
                    icon-position="after"
                    href="https://github.com/electrikhq/{{$project}}-docs/issues/new?title=Feedback%20For%20{{$title}}%20({{ $slug }}.md)" 
                    traget="_blank"
                >
                Question? Give us feedback
                </x-slate::button>
                <br/>
                <x-slate::button
                    size="sm"
                    color="white" 
                    icon="carbon-arrow-right"
                    icon-position="after"
                    target=_blank
                    href="https://github.com/electrikhq/{{ $project }}-docs/edit/{{ $version }}/{{$slug}}.md"
                >
                Contibute to this page
                </x-slate::button>
            </div>
        </div>
    </div>
@endsection