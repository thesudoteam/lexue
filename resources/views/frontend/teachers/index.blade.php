@extends('frontend.layouts.app')

@section('content')
    @foreach($teachers as $teacher)
            <div class="col-lg-3">
                <div class="contact-box center-version">
                    <a href="{{ route('students::teachers.show', $teacher->id) }}">

                        <img alt="image" class="img-circle" src="{{ getAvatar($teacher->avatar, 'sm') }}">
                        <h3 class="m-b-xs">{{ $teacher->name }}</h3>

                        <div class="font-bold">
                            ￥{{ $teacher->unit_price }}.00/时
                            <br>
                            <small>{{ $teacher->levels->implode('name', ',') }}</small>
                        </div>
                        <p class="m-t-md">{{ str_limit($teacher->description, 40) }}</p>

                    </a>
                </div>
            </div>
    @endforeach
@endsection