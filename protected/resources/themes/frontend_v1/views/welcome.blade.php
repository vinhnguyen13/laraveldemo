@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>
                <div class="panel-body">
                    Your Application's Landing Page.
                    <p>
                        Random text: {{ $content }}
                    </p>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><b>Language:</b><i>{{ trans('general.langactive') }}</i></div>
                <div class="panel-body">
                    <p>
                        Chose: <a href="{{action('LanguageController@choose', ['locale'=>'en'])}}">EN</a> <a href="{{action('LanguageController@choose', ['locale'=>'vi'])}}">VN</a>
                    </p>
                    <p>
                        Route translate: <a href="{{action('HomeController@index')}}">{{action('HomeController@index')}}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
