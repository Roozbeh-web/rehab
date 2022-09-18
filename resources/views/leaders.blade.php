@extends('base')
@extends('templates.dashNav')

@section('content')
@livewireStyles
    <livewire:leaders />
@livewireScripts
@endsection


@extends('templates.dashFoot')