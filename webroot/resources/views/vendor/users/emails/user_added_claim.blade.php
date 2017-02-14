@extends('frontend.layouts.email')

@section('subject', 'Claim')

@section('title','Claim')

@section('main')

<p>Hi Mr/Mrs,</p>
<p>The user {{$user->first_name}} {{$user->last_name}} has made a <a href="{{ env('APP_URL') }}/admin/claims/{{ $claim->id }}/view">claim</a></p>
<p>Here is the claim description:<br><i>{{$data['description']}}</i></p>

@endsection
