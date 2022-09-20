@extends('base')
@extends('templates.dashNav')

@section('content')
@livewireStyles
    <livewire:leader-plan />
@livewireScripts
@endsection


@extends('templates.dashFoot')