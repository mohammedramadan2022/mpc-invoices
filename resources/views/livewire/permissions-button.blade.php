<div class="width-80px text-center">

    @if(isset($permissionsRoute))
        <a href="{{ $permissionsRoute }}"
           class="btn px-2 text-primary fs-3 py-2 {{ $permissionsRoute ?? '' }}  @isset($isDefaultAdmin) {{$isDefaultAdmin == 1 ? 'd-none' : ''}}"
           @endisset data-bs-toggle="tooltip" title="{{__('messages.common.permissions')}}">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    @endif

</div>
