@extends('layouts.app')
@section('title')
    {{ __('messages.permissions') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column ">
            {!! Form::model($user, [
      'route' => ['user-permissions.store', $user->id],
      'method' => 'post',
      'files' => true,
  ]) !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name"> <b>User Name</b> :{{ $user->full_name }} </label>

                        @error('name')
                        <span class="text-danger">{{ $user->full_name }}</span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">

                    <div class="form-group">
                        <h2>
                            <label>Permissions</label>
                            <br>
                        </h2>
                        @inject('permissionModel', 'Spatie\Permission\Models\Permission')
                        <div class="row">
                            @foreach ($permissions as $value)
                                <div class="col-md-6" style="padding: 10px;" >
                                    <div class="card" >
                                        <div class="card-body card-bordered">


                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <h3>{{ __($value->category) }}</h3>
                                                    <h5 class="custom-check pull-right"
                                                           for="{{ str_replace(' ', '_', __($value->category)) }}">
                                                        <input type="checkbox" class="selectSameGroup"
                                                               id="{{ str_replace(' ', '_', __($value->category)) }}">
                                                        <span class="checkmark"></span>
                                                        &nbsp {{ __(' select all') }} &nbsp
                                                    </h5>
                                                </div>
                                                <div class="panel-body">
                                                    @foreach ($permissionModel->where('category', $value->category)->get() as $value)
                                                        <div class="col-md-4">
                                                            <label class="custom-check">
                                                                {!! Form::checkbox('permission[]', $value->id, $user->hasPermissionTo($value->id) ? true : false, [
                                                                    'class' => str_replace(' ', '_', __($value->category)),
                                                                ]) !!}
                                                                <span class="checkmark"></span>
                                                                {{ __($value->display_name) }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                                @if ($loop->iteration % 2 == 0)
                                    <div class="clearfix"></div>
                                @endif
                            @endforeach
                        </div>
                        <div class="ibox-footer">
                            <button type="submit" class="btn btn-primary">save</button>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
                @stop


                @section('scripts')
                    <script>
                        $(".selectSameGroup").click(function () {
                            let group = $(this).attr('id');
                            $('.' + group).prop('checked', $(this).prop('checked'));
                        });
                    </script>
@stop
