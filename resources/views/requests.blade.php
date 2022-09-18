@extends('base')
@extends('templates.dashNav')

@section('content')
@livewireStyles
    <livewire:requests />
@livewireScripts
@endsection


@extends('templates.dashFoot')