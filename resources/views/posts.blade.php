@extends('base')
@extends('templates.dashNav')

@section('content')
@livewireStyles
    <livewire:posts />
@livewireScripts
@endsection


@extends('templates.dashFoot')