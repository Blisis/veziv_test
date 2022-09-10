@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                    <div class="float-end">
                        <a href="" class="btn btn-primary btn-sm">Adauga programare</a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session()->get('success'))
                        <div class="alert alert-info">{{ session()->get('success') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">Data</div>
                        <div class="col-md-4">Ora</div>
                        <div class="col-md-4">Actiuni</div>
                    </div>
                    @foreach($appointments as $appointment)
                        <div class="appointment">
                            <div class="row">
                                <div class="col-md-4">
                                    {{ $appointment->date }}
                                </div>
                                <div class="col-md-4">
                                    {{ $appointment->hour }}
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-success">Modifica</a>
                                    <a href="{{ route('appointments.destroy', $appointment->id) }}" class="btn btn-sm btn-danger">Sterge</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
