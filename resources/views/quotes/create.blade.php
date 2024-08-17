@extends('layouts.app')
@section('title')
    {{ __('messages.quote.new_quote') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-5">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end">
                <a class="btn btn-outline-primary float-end"
                   href="{{ url()->previous() }}">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                    <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => 'quotes.store', 'id' => 'quoteForm', 'name' => 'quoteForm']) }}
                    @include('quotes.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    @include('quotes.templates.templates')
    {{ Form::hidden('clients',json_encode($clients, true),['id' => 'clients']) }}
    {{ Form::hidden('products',json_encode($associateProducts, true),['id' => 'products']) }}
    {{ Form::hidden('quote_note',isset($quote->note) ,['id' => 'quoteNote']) }}
    {{ Form::hidden('quote_term',isset($quote->term) ,['id' => 'quoteTerm']) }}
    {{ Form::hidden('quote_recurring',isset($quote->recurring) ,['id' => 'quoteRecurring']) }}
    {{ Form::hidden('thousand_separator',getSettingValue('thousand_separator') ,['id' => 'thousandSeparator']) }}
    {{ Form::hidden('decimal_separator',isset($quote->recurring) ,['id' => 'decimalSeparator']) }}

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#client_id').change(function() {
            var clientId = $(this).val();
            if (clientId) {
                $.ajax({
                    url: '{{ route("quotes.getLastQuoteId") }}',
                    type: 'GET',
                    data: { client_id: clientId },
                    success: function(response) {
                        // Handle the response, e.g., update a hidden input with the last invoice ID

                        $('#quoteId').val(response.last_quote_id);
                    },
                    error: function(e) {
                        alert('An error occurred while fetching the last invoice ID.');
                    }
                });
            }
        });
    });
</script>
