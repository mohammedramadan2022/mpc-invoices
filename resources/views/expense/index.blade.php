@extends('layouts.app')
@section('title')
    {{ __('messages.expenses') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column ">
            @include('flash::message')
            <livewire:expense-table lazy />
        </div>
    </div>
    @include('expense.create_modal')
    @include('expense.edit_modal')
@endsection
