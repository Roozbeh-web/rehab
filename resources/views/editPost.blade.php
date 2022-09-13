@extends('base')
@extends('templates.dashNav')

@section('content')
@livewireStyles
    <livewire:edit-post />
@livewireScripts
@endsection


@extends('templates.dashFoot')