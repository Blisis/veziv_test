@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Listare programari
                    </div>
                    <div class="card-body">
                        @if($appointments->count())
                            @foreach($appointments as $appointment)
                                <div class="appointment">
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{ $appointment->user->name }}
                                        </div>
                                        <div class="col-md-3">
                                            {{ $appointment->date }}
                                        </div>
                                        <div class="col-md-3">
                                            {{ $appointment->hour }}
                                        </div>
                                        <div class="col-md-3">
                                            <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn btn-success btn-sm">Modifica</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $appointments->links() }}
                        @else
                            <em>Nu Avem programari!</em>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
