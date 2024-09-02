<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="icon" href="{{ asset('web/media/logos/favicon.ico') }}" type="image/png">
    <title>{{ __('messages.invoice.invoice_pdf') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/invoice-pdf.css') }}" rel="stylesheet" type="text/css" />
    <style>
        * {
            font-family: DejaVu Sans, Arial, "Helvetica", Arial, "Liberation Sans", sans-serif;
        }

        @page {
            margin-top: 40px !important;
        }

        .img-logo {
            width:auto  !important;  /* Force the width */
            height: 200px !important;  /* Maintain aspect ratio */
        }

        @if (getInvoiceCurrencyIcon($invoice->currency_id) == '€')
            .euroCurrency {
            font-family: Arial, "Helvetica", Arial, "Liberation Sans", sans-serif;
        }
        @endif
    </style>
</head>

<body style="padding: 0rem 2rem;">
@php $styleCss = 'style'; @endphp
<div class="preview-main client-preview tokyo-template">
    <div class="d" id="boxes">
        <div>
            <table class="mb-3 w-100">
                <tr>
                    <td>
                        <img src="{{ getLogoUrl() }}" class="img-logo" alt="logo" style="width: 200px !important; height: auto !important;"> <!-- Inline style to force size -->
                    </td>
                    <td class="heading-text">
                        <div class="text-end">
                            <h1 class="m-0 text-black" style="color: {{ $invoice_template_color }}">
                                {{ __('messages.common.invoice') }}
                            </h1>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <table class="my-3 w-100">
                    <tbody>
                    <tr style="vertical-align:top;">
                        <td width="36.33%">
                            <p class="fs-6 mb-2 font-gray-900">
                                <strong>{{ __('messages.common.to') . ':' }}</strong>
                            </p>
                            <p class=" mb-1 font-color-gray fs-6">{{ __('messages.setting.company_name') . ':' }} <span
                                    class="font-gray-900">{{ $client->company_name }}</span></p>
                            <p class=" mb-1 font-color-gray fs-6">{{ __('messages.common.name') . ':' }} <span
                                    class="font-gray-900">{{ $client->user->full_name }}</span></p>
                            <p class="mb-1 font-color-gray fs-6">{{ __('messages.common.email') . ':' }}
                                <span class="font-gray-900">{{ $client->user->email }}</span>
                            </p>
                            <p class="mb-1 font-color-gray fs-6">{{ __('messages.common.address') . ':' }}
                                <span class="font-gray-900">{{ $client->address }} </span>
                            </p>
                            <p class="mb-1 font-color-gray fs-6">{{ __('messages.common.phone') . ':' }}
                                <span class="font-gray-900">{{ $client->user->contact }} </span>
                            </p>
                        </td>
                        <td width="36.33%">
                            <p class="fs-6 mb-2 font-gray-900">
                                <strong>{{ __('messages.common.from') . ':' }}</strong>
                            </p>
                            <p class=" mb-1 font-color-gray fw-bold fs-6">
                                {{ __('messages.common.name') . ':' }}&nbsp; <span
                                    class="font-gray-900">{!! $setting['company_name'] !!}</span></p>
                            <p class=" mb-1 font-color-gray fs-6">
                                {{ __('messages.common.address') . ':' }}&nbsp; <span
                                    class="font-gray-900">{!! $setting['company_address'] !!}</span></p>
                            @if (isset($setting['show_additional_address_in_invoice']) && $setting['show_additional_address_in_invoice'] == 1)
                                <p class=" m-0 font-gray-900 fs-6">
                                    {{ $setting['zipcode'] . ', ' . $setting['city'] . ', ' . $setting['state'] . ', ' . $setting['country'] }}
                                </p>
                            @endif
                            <p class=" mb-1 font-color-gray  fw-bold fs-6">
                                {{ __('messages.user.phone') . ':' }}&nbsp; <span
                                    class="font-gray-900">{{ $setting['company_phone'] }}</span></p>
                            @if (isset($setting['show_additional_address_in_invoice']) && $setting['show_additional_address_in_invoice'] == 1)
                                <p class="mb-1 font-color-gray fw-bold fs-6">
                                    <strong>{{ __('messages.invoice.fax_no') . ':' }}&nbsp;</strong><span>{{ $setting['fax_no'] }}</span>
                                <p>
                            @endif
                            @if (!empty($setting['gst_no']))
                                <p class=" mb-1 font-color-gray fs-6">{{ getVatNoLabel() . ':' }} <span
                                        class="font-gray-900">{{ $setting['gst_no'] }}</span></p>
                            @endif
                        </td>
                        <td width="33.33%" class="text-end pt-7">
                            <p class="mb-1 text-gray-600 fs-6"><strong
                                    class="font-gray-900">{{ __('messages.invoice.invoice') . ':' }}
                                </strong>{{ $invoice->invoice_id }}
                            </p>
                            <p class="mb-1 text-gray-600 fs-6"><strong
                                    class="font-gray-900">{{ __('messages.invoice.invoice_date') . ':' }}
                                </strong>{{ \Carbon\Carbon::parse($invoice->invoice_date)->translatedFormat(currentDateFormat()) }}
                            </p>
                            <p class=" mb-1 text-gray-600 fs-6"><strong
                                    class="font-gray-900">{{ __('messages.invoice.due_date') . ':' }}&nbsp;
                                </strong>{{ \Carbon\Carbon::parse($invoice->due_date)->translatedFormat(currentDateFormat()) }}
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="w-100 overflow-auto">
                <table class="invoice-table w-100">
                    <thead {{ $styleCss }}="background-color: {{ $invoice_template_color }};">
                    <tr>
                        <th class="p-2" style="width:5% !important;">#</th>
                        <th class="p-2 in-w-2">{{ __('messages.Description') }}</th>
                        <th class="p-2 text-center" style="width:9% !important;">
                            {{ __('messages.invoice.qty') }}
                        </th>
                        <th class="p-2 text-center text-nowrap" style="width:15% !important;">
                            {{ __('messages.product.unit_price') }}</th>
                        <th class="p-2 text-end text-nowrap" style="width:14% !important;">
                            {{ __('messages.invoice.amount') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($invoice) && !empty($invoice))
                        @foreach ($invoice->invoiceItems as $key => $invoiceItems)
                            <tr>
                                <td style="width:5%;"><span>{{ $key + 1 }}</span></td>
                                <td class=" in-w-2">
                                    <p class="fw-bold mb-0">
                                        {{ isset($invoiceItems->product->name) ? $invoiceItems->product->name : $invoiceItems->product_name ?? __('messages.common.n/a') }}
                                    </p>
                                    @if (
                                        !empty($invoiceItems->product->description) &&
                                            (isset($setting['show_product_description']) && $setting['show_product_description'] == 1))
                                        <span
                                            style="font-size: 12px; word-break: break-all !important">{{ $invoiceItems->product->description }}</span>
                                    @endif
                                </td>
                                <td class="text-center text-nowrap">
                                    {{ number_format($invoiceItems->quantity, 2) }}
                                </td>
                                <td class="text-center text-nowrap">
                                    {{ isset($invoiceItems->price) ? getInvoiceCurrencyAmount($invoiceItems->price, $invoice->currency_id, true) : __('messages.common.n/a') }}
                                </td>
                                <td class="text-end text-nowrap">
                                    {{ isset($invoiceItems->total) ? getInvoiceCurrencyAmount($invoiceItems->total, $invoice->currency_id, true) : __('messages.common.n/a') }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="my-4">
                <table class="ms-auto mb-10 text-end w-100">
                    <tr>
                        <td class="w-75"></td>
                        <td class="w-25">
                            <table class="w-100">
                                <tbody>
                                <tr>
                                    <td class="py-1 text-gray-600 fs-6">
                                        <strong>{{ __('messages.invoice.sub_total') }}:</strong></td>
                                    <td class="py-1 text-gray-900 fs-6">
                                        {{ getInvoiceCurrencyAmount($invoice->sub_total, $invoice->currency_id, true) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 text-gray-600 fs-6">
                                        <strong>{{ __('messages.invoice.discount') }}:</strong></td>
                                    <td class="py-1 text-gray-900 fs-6">
                                        {{ getInvoiceCurrencyAmount($invoice->discount, $invoice->currency_id, true) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 text-gray-600 fs-6">
                                        <strong>{{ __('messages.invoice.tax') }}:</strong></td>
                                    <td class="py-1 text-gray-900 fs-6">
                                        {{ getInvoiceCurrencyAmount($invoice->tax, $invoice->currency_id, true) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 text-gray-600 fs-6">
                                        <strong>{{ __('messages.invoice.total') }}:</strong></td>
                                    <td class="py-1 text-gray-900 fs-6">
                                        {{ getInvoiceCurrencyAmount($invoice->total_amount, $invoice->currency_id, true) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 text-gray-600 fs-6">
                                        <strong>{{ __('messages.invoice.paid') }}:</strong></td>
                                    <td class="py-1 text-gray-900 fs-6">
                                        {{ getInvoiceCurrencyAmount($invoice->payments->sum('amount'), $invoice->currency_id, true) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 text-gray-600 fs-6">
                                        <strong>{{ __('messages.invoice.due_amount') }}:</strong></td>
                                    <td class="py-1 text-gray-900 fs-6">
                                        {{ getInvoiceCurrencyAmount($invoice->total_amount - $invoice->payments->sum('amount'), $invoice->currency_id, true) }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
                <br>
            </div>
        </div>
    </div>
</div>
</body>

</html>
