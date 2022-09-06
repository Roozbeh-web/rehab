@extends('base')
@extends('templates.dashNav')

@section('content')
@livewireStyles
<livewire:edit-profile />
@livewireScripts
@endsection


@extends('templates.dashFoot')