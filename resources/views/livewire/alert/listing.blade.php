<div>
    @if (!empty($authToken))
        @if (!empty($alerts))
            <ul>
                @foreach ($alerts as $alert)
                    <li>{{ $alert['title'] }}</li>
                @endforeach
            </ul>
        @endif
    @else
        no token
    @endif
</div>
