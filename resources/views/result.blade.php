@extends('layouts.app')

@section('head')
<style>

.result {
    width: 25rem;
    max-width: 100%;
    margin-left: auto;
    margin-right: auto;
}

.result__score {
    font-size: 5rem;
}

.result__rank {
    font-size: 1.5rem;
}

.result__invite {
    text-align: center;
}

</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1 class="card-header text-muted">結果発表</h1>

                <div class="card-body pb-5">
                    <div class="result">
                        <p class="text-center">あなたのスコアは</p>
                        <p class="result__score text-center">{{ $score }}</p>
                        <p class="result__rank text-center">順位: 100 / 10000</p>

                        <div class="mt-5">
                            @guest
                                <p class="result__invite"><span class="d-inline-block">会員登録をして、</span><span class="d-inline-block">スコアを記録しませんか？</span></p>
                                <a href="{{ route('register') }}" class="btn btn-primary btn-block btn-lg">会員登録</a>
                            @else
                                <a href="{{ route('play') }}" class="btn btn-primary btn-block btn-lg">もう一回</a>
                            @endguest
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
