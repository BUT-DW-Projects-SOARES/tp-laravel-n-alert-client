<div>
    @if (!empty($authToken))
        @if (!empty($errors))
            <ul>
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @else
            @if (!empty($alerts))
                <ul>
                    @foreach ($alerts as $alert)
                        <li>{{ $alert['title'] }}</li>
                    @endforeach
                </ul>
            @endif
        @endif
    @else
        no token
    @endif
</div>
