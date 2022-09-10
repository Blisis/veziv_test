@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Programare noua
                    </div>
                    <div class="card-body">
                        @if(session()->get('success'))
                            <div class="alert alert-info">{{ session()->get('success') }}</div>
                        @endif
                        <form action="{{ route('appointments.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Data</label>
                                <input type="date" class="form-control selectDate" name="date">
                                @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="hour">Ora</label>
                                <select class="form-control avaiableHours" name="hour" id=""></select>
                                @error('hour')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-primary">creaza</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var appUrl = '{{ URL::to('/') }}';
        // Detect date changed and get the available hours
        const selectElement = document.querySelector('.selectDate');

        selectElement.addEventListener('change', (event) => {
            let selectedDate = event.target.value;
            let ajaxData = {
                'date': selectedDate
            };

            let getHoursUrl = appUrl + '/appointments/get-hours';

            $.ajax({
                method: 'GET',
                url: getHoursUrl,
                data: ajaxData
            }).done(function(response) {
                $('.avaiableHours').empty();
                $.each(response, function(key, item){
                    $('.avaiableHours').append($('<option>', {
                        value: item,
                        text: item
                    }));
                });
            })
            .fail(function() {
                alert( "error" );
            });
        });
    </script>
@endsection
