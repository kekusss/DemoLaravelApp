Witaj!

Lista ulubionych produktów:

    @foreach($favorites as $item)
        {{ $item->id }} : {{ $item->name }}
    @endforeach
