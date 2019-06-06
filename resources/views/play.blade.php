@extends('layouts.app')

@section('content')
<number-panel url="{{ route('result') }}">
@csrf
</number-panel>
@endsection

@section('script')
<script type="application/json" id="play_option">
[
    {
        "times": 3,
        "digits": 1,
        "quantity": 3,
        "interval": 1000
    },
    {
        "times": 3,
        "digits": 2,
        "quantity": 3,
        "interval": 1000
    },
    {
        "times": -1,
        "digits": 2,
        "quantity": 5,
        "interval": 500
    }
]
</script>
@endsection
