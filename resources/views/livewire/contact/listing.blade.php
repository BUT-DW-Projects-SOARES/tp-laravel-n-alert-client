<div>
    @if (!empty($authToken))
        @if (!empty($errors))
            <ul>
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @else
            @if (!empty($contacts))
                <ul>
                    @foreach ($contacts as $contact)
                        <li>{{ $contact['attributes']['firstname'] }} {{ $contact['attributes']['lastname'] }}</li>
                    @endforeach
                </ul>
            @endif
        @endif
    @else
        no token
    @endif
</div>
