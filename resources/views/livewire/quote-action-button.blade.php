<div class="dropup position-static" wire:key="{{ $row->id }}">


    @can('quotes.pdf')
        <a class="px-2" href="{{ route('quotes.pdf', $row->id) }}" target="_blank"><i
                class="fa-solid fa-download fs-2"></i></a>
    @endcanany

    @canany('quotes.convert-to-invoice' , 'quotes.edit' ,'quotes.delete' ,'quotes.index')
        <button wire:key="quote-{{ $row->id }}" type="button" title="Action"
                class="dropdown-toggle hide-arrow btn px-2 text-primary fs-3 pe-0" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" data-bs-boundary="viewport" aria-expanded="false">
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </button>
        <ul class="dropdown-menu min-w-170px" aria-labelledby="dropdownMenuButton1">
            @php
                $isEdit = $row->status == 0 ? 0 : 1;
            @endphp
            @if ($isEdit != 1)
                @can('quotes.convert-to-invoice')
                    <li>
                        <a href="#" data-id="{{ $row->id }}"
                           class="convert-to-invoice dropdown-item me-1 text-hover-primary" data-bs-toggle="tooltip"
                           title="{{ __('messages.quote.convert_to_invoice') }}">
                            {{ __('messages.quote.convert_to_invoice') }}
                        </a>
                    </li>
                @endcan
                @can('quotes.edit')

                    <li>
                        <a href="{{ route('quotes.edit', $row->id) }}"
                           class="dropdown-item text-hover-primary me-1 edit-btn"
                           data-bs-toggle="tooltip" title="{{ __('messages.common.edit') }}" data-turbo="false">
                            {{ __('messages.common.edit') }}
                        </a>
                    </li>
                    @endcan
                @endif
            @can('quotes.delete')

            <li>
                    <a href="#" data-id="{{ $row->id }}"
                       class="delete-btn dropdown-item me-1 text-hover-primary quote-delete-btn"
                       data-bs-toggle="tooltip"
                       title="{{ __('messages.common.delete') }}">
                        {{ __('messages.common.delete') }}
                    </a>
                </li>
            @endcan
            @can('quotes.index')

            <li>
                    <a href="javascript:void(0)" data-url="{{ route('quote-show-url', $row->quote_id) }}"
                       class="dropdown-item text-hover-primary me-1 edit-btn  quote-url" data-bs-toggle="tooltip"
                       title="{{ __('messages.quote.quote_url') }}" onclick="copyToClipboard($(this).data('url'))">
                        {{ __('messages.quote.quote_url') }}
                    </a>
                </li>

                @endcan
        </ul>
    @endcanany
</div>
