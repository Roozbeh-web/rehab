@extends('base')
@extends('templates.dashNav')

@section('content')
@livewireStyles
    <livewire:new-plan />
@livewireScripts
@endsection


@extends('templates.dashFoot')