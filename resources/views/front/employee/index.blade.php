@extends("layout.template")
@section("view")
    {{--
    @foreach($employee as $key => $val)
        <p>
            {{$key . " => " . $val}}
            @if($key == "name" && $val != "Hamza Salah")
                {{$key . " => " . "Unknown"}}
            @endif
        </p>
    @endforeach
    --}}
    @forelse($employee as $key => $val)
        <p>
            {{$key . " => " . $val}}
            @if($key == "name" && $val != "Hamza Salah")
                {{$key . " => " . "Unknown"}}
            @endif
        </p>
    @empty
        <p>Sorry no data to show</p>
    @endforelse
@stop
