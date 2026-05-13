@if (isset($breadcrumbs) && count($breadcrumbs) > 0)
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                @if (isset($breadcrumb['url']))
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                    </li>
                @else
                    <li class="breadcrumb-item active">{{ $breadcrumb['title'] }}</li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
