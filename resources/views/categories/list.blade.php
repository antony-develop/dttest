<li><a href="/catalog{{ $element['category']['link'] }}">{{ $element['category']['title'] }}</a></li>
@if (count($element['children']) > 0)
    <ul>
        @foreach($element['children'] as $element)
            @include('categories.list', $element)
        @endforeach
    </ul>
@endif