<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="icon" href="{{ asset('web/media/logos/favicon.ico') }}" type="image/png">
    <title>{{ __('messages.invoice.invoice_pdf') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/invoice-pdf.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        * {
            font-family: DejaVu Sans, Arial, "Helvetica", Arial, "Liberation Sans", sans-serif;
        }

        @page {
            margin-top: 40px !important;
        }

        @if (getCurrencySymbol() == '€')
            .euroCurrency {
            font-family: Arial, "Helvetica", Arial, "Liberation Sans", sans-serif;
        }

        @endif

        .amount-table td {
            padding: 8px 0;
        }

        .amount-table .label {
            text-align: left;
            font-weight: bold;
        }

        .amount-table .value {
            text-align: left;
        }

        .footer-stamp-container {
            position: fixed;
            bottom: 0;
            left: 0;
            padding: 100px; /* Add padding around the stamp image */
            /*z-index: 10; !* Ensure the stamp is above other content *!*/
        }

        .footer-stamp {
            width: 200px; /* Adjust the width as needed */
            height: auto;
        }

        .footer {
            width: 100%;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            padding-top: 10px;
            font-size: 12px;
            background-color: #fff; /* Add background to cover content if needed */
            overflow: hidden; /* Hide any overflow content */
            z-index: 1; /* Ensure the footer is behind the stamp */
        }

        .footer img {
            width: 100% !important; /* Adjust the image width as needed */
            /*max-width: 200px; !* Example maximum width *!*/
            height: auto;
            padding-bottom: 10px;
        }


        .footer i {
            margin-right: 5px;
        }

        .footer p {
            margin: 0;
            display: inline-block;
            padding: 0 15px;
        }

        body {
            background: url('{{ asset('images/watermark.png') }}') no-repeat center center;
            background-size: contain;
            /*opacity: 0.1; !* Adjust opacity for watermark effect *!*/
            position: relative;
        }

        .preview-main {
            position: relative;
            z-index: 1; /* Ensure content is above the watermark */
        }


        .client-preview .img-logo {
            width: 250px !important;
            max-width: none !important;
            max-height: none !important;
            height: 100px !important;
        }

        .client-preview td {
            width: auto;
            padding: 0;
        }


    </style>
</head>

<body style="padding: 0rem 2rem;">
@php $styleCss = 'style'; @endphp
<div class="preview-main client-preview tokyo-template">
    <div class="d" id="boxes">
        <div>
            <table class="dmb-3 w-100">
                <tr>
                    <td style="vertical-align:top; width: 35%;" class="pt-5">
                        <img width="100px" src="{{ getLogoUrl() }}" alt="" class="img-logo">
                    </td>
                    <td style="width: 35%;" class="pt-5">
                        <p class="p-text mb-0">{{ __('messages.invoice.invoice_id') . ':' }}&nbsp;
                            <strong>{{ $invoice->invoice_id }}</strong>
                        </p>
                        <p class="p-text mb-0">{{ __('messages.invoice.invoice_date') . ':' }}
                            <strong>{{ \Carbon\Carbon::parse($invoice->invoice_date)->translatedFormat(currentDateFormat()) }}</strong>
                        </p>
                        <p class="p-text mb-0">{{ __('messages.invoice.due_date') . ':' }}&nbsp;
                            <strong>{{ \Carbon\Carbon::parse($invoice->due_date)->translatedFormat(currentDateFormat()) }}</strong>
                        </p>
                    </td>
                    <td class="in-w-4 pt-5"
                    {{ $styleCss }}=" width: 20%;">
                    <h1 class="fancy-title tu text-center mb-auto p-3" style="  font-size: 25px">
                        <b>{{ __('messages.common.invoice') }}</b>
                    </h1>
                    </td>
                </tr>
            </table>
            <div class="">
                <table class="table table-bordered w-100">
                    <thead class="bg-light">
                    <tr>
                        <th class="py-1 text-uppercase" style="width:33.33% !important;">
                            {{ __('messages.common.from') }}</th>
                        <th class="py-1 text-uppercase" style="width:33.33% !important;">{{ __('messages.common.to') }}
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="py-1">
                            <b>{{ __('messages.common.name') . ':' }}&nbsp;</b>{!! $setting['company_name'] !!}<br>
                            <b>{{ __('messages.common.address') . ':' }}&nbsp;</b>{!! $setting['company_address'] !!}
                            <br>
                            <b>{{ __('messages.user.phone') . ':' }}&nbsp;</b>{{ $setting['company_phone'] }}<br>
                            {{--                            @if (!empty($setting['gst_no']))--}}
                            {{--                                <b>{{ getVatNoLabel() . ':' }}&nbsp;</b>{{ $setting['gst_no'] }}--}}
                            {{--                            @endif--}}
                        </td>
                        <td class="py-1" style=" overflow:hidden; word-wrap: break-word; word-break: break-all;">

                            <b>{{ __('messages.setting.company') . ':' }}&nbsp;</b>{{ $client->company_name }}<br>
                            <b>{{ __('messages.client.attention') . ':' }}&nbsp;</b>{{ $client->user->full_name }}<br>
                            <b>{{ __('messages.common.email') . ':' }}</b>
                            <span style="width:200px; word-break: break-word !important;">
                                {{ $client->user->email }}</span><br>

                            <b>{{ __('messages.common.address') . ':' }}&nbsp;</b>{{ $client->address }}<br>
                            <b>{{ __('messages.common.shop_name') . ':' }}&nbsp;</b>{{ $invoice->shop_name }}<br>
                            <b>{{ __('messages.common.location') . ':' }}&nbsp;</b>{{ $invoice->location }}<br>
                            @if($invoice->po_number)

                                <b>{{ __('messages.common.PO') . ':' }}&nbsp;</b>{{ $invoice->po_number }}<br>

                            @endif
                            @if($invoice->service_report_number)

                                <b>{{ __('messages.common.service_report_number') . ':' }}&nbsp;</b>{{ $invoice->service_report_number }}

                            @endif
                            {{--                            @if (!empty($client->vat_no))--}}
                            {{--                                <br><b>{{ getVatNoLabel() . ':' }}&nbsp;</b>{{ $client->vat_no }}--}}
                            {{--                            @endif--}}
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="w-100 overflow-auto">
                <table class="invoice-table w-100">
                    <thead {{ $styleCss }}="background-color: {{ $invoice_template_color }};">
                    <tr>
                        <th class="p-2" style="width:5% !important;">SN</th>
                        <th class="p-2 in-w-2">{{ __('messages.Description') }}</th>
                        <th class="p-2 text-center" style="width:9% !important;">
                            {{ __('messages.invoice.qty') }}
                        </th>
                        <th class="p-2 text-center" style="width:9% !important;">
                            {{ __('messages.common.unit') }}
                        </th>
                        <th class="p-2 text-center text-nowrap" style="width:15% !important;">
                            {{ __('messages.product.unit_price') }}</th>
                        {{-- <th class="p-2 text-center text-nowrap" style="width:13% !important;">
                             {{ __('messages.invoice.tax') . '(in %)' }}
                         </th>--}}
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
                                    @endif
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
                                    {{ $invoiceItems->unit }}
                                </td>
                                <td class="text-center text-nowrap">
                                    {{ isset($invoiceItems->price) ? getInvoiceCurrencyAmount($invoiceItems->price, $invoice->currency_id, true) : __('messages.common.n/a') }}
                                </td>

                                {{--  <td class="text-center text-nowrap">
                                      @foreach ($invoiceItems->invoiceItemTax as $keys => $tax)
                                          {{ $tax->tax ?? '--' }}
                                          @if (!$loop->last)
                                              ,
                                          @endif
                                      @endforeach
                                  </td>--}}
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
                                @if ($invoice->discount > 0)
                                    <tr>
                                        <td class="py-1 px-0 font-dark-gray text-nowrap">
                                            <strong>{{ __('messages.invoice.sub_total') . ':' }}</strong>
                                        </td>
                                        <td class="text-end font-gray-600 py-1 px-0 fw-bold text-nowrap">
                                            {{ getInvoiceCurrencyAmount($invoice->amount, $invoice->currency_id, true) }}
                                        </td>
                                    </tr>
                                @endif
                                @if ($invoice->discount > 0)

                                    <tr>
                                        <td class="py-1 px-0 font-dark-gray text-nowrap">
                                            <strong>{{ __('messages.invoice.discount') . ':' }}</strong>
                                        </td>


                                        <td class="text-end font-gray-600 py-1 px-0 fw-bold text-nowrap">
                                            @if ($invoice->discount == 0)
                                                <span>{{ __('messages.common.n/a') }}</span>
                                            @else
                                                @if (isset($invoice) && $invoice->discount_type == \App\Models\Invoice::FIXED)
                                                    <b
                                                        class="euroCurrency">{{ isset($invoice->discount) ? getInvoiceCurrencyAmount($invoice->discount, $invoice->currency_id, true) : __('messages.common.n/a') }}</b>
                                                @else
                                                    {{ $invoice->discount }}<span
                                                    {{ $styleCss }}="font-family: DejaVu Sans">&#37;</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>

                                @endif
                                @if ($invoice->taxes != 0)
                                    <tr>
                                        @php
                                            $itemTaxesAmount = $invoice->amount + array_sum($totalTax);
                                            $invoiceTaxesAmount =
                                                ($itemTaxesAmount * $invoice->invoiceTaxes->sum('value')) / 100;
                                            $totalTaxes = array_sum($totalTax) + $invoiceTaxesAmount;
                                        @endphp


                                        <td class="pt-1 pb-2 px-0 font-dark-gray text-nowrap">
                                            <strong>{{ __('messages.invoice.tax') . ':' }}</strong>
                                        </td>


                                        <td class="text-end font-gray-600 pt-1 pb-2 px-0 fw-bold text-nowrap">
                                            {!! numberFormat($totalTaxes) != 0
                                                ? '<b class="euroCurrency">' . getInvoiceCurrencyAmount($totalTaxes, $invoice->currency_id, true) . '</b>'
                                                : __('messages.common.n/a') !!}
                                        </td>


                                    </tr>
                                @endif
                                <tr>
                                    <td class="py-1 px-0 font-dark-gray text-nowrap">
                                        <strong>{{ __('messages.invoice.total') . ':' }}</strong>
                                    </td>
                                    <td class="text-end font-gray-600 py-1 px-0 fw-bold text-nowrap">
                                        {{ getInvoiceCurrencyAmount($invoice->final_amount, $invoice->currency_id, true) }}
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot class="total-amount">
                                <tr>
                                    <td class="py-2 font-dark-gray text-nowrap">
                                        <strong>{{ __('messages.admin_dashboard.total_due') . ':' }}</strong>
                                    </td>
                                    <td class="text-end font-dark-gray py-2 fw-bold text-nowrap">
                                        {{ getInvoiceCurrencyAmount(getInvoiceDueAmount($invoice->id), $invoice->currency_id, true) }}
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </td>
                    </tr>
                </table>
                <div style="vertical-align:bottom; width:60%;">
                    @if (!empty($invoice->paymentQrCode))
                        <img class="mt-4" src="{{ $invoice->paymentQrCode->qr_image }}" height="100"
                             width="100" alt="qr-code-image">
                    @endif
                </div>
            </div>
            <div class="mt-20">
                @if (!empty($invoice->note))
                    <div class="mb-5 pt-10">
                        <h6 class="font-gray-900 mb5"><b>{{ __('messages.client.notes') . ':' }}</b></h6>
                        <p class="font-gray-600">{!! nl2br($invoice->note ?? __('messages.common.not_available')) !!}
                        </p>
                    </div>
                @endif
                <table class="mb-3 w-100">
                    <tr>
                        @if (!empty($invoice->term))
                            <td class="w-50">
                                <div>
                                    <h6 class="font-gray-900 mb5"><b>{{ __('messages.invoice.terms') . ':' }}</b></h6>
                                    <p class="font-gray-600 mb-0">{!! nl2br($invoice->term ?? __('messages.common.not_available')) !!}
                                    </p>
                                </div>
                            </td>
                        @endif
                    </tr>
                    {{--                    <tr>--}}
                    {{--                        <td class="w-25 text-">--}}
                    {{--                            <div>--}}
                    {{--                                <h6 class="font-dark-gray mb5"><b>{{ __('messages.setting.regards') . ':' }}</b>--}}
                    {{--                                </h6>--}}
                    {{--                                <p class="fs-6"--}}
                    {{--                                {{ $styleCss }}="color:--}}
                    {{--                                    {{ $invoice_template_color }}">--}}
                    {{--                                {{ html_entity_decode($setting['app_name']) }}</p>--}}
                    {{--                            </div>--}}
                    {{--                        </td>--}}
                    {{--                    </tr>--}}
                </table>


                <div class="footer-stamp-container">
                    <img src="{{ asset('images/stamp.png') }}" alt="Stamp Image" class="footer-stamp">

                    <p class=""
                    {{ $styleCss }}="color:
                                                            {{ $invoice_template_color }}">
                    {{ html_entity_decode($setting['app_name']) }}-management</p>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="footer">
    <img src="{{ asset('images/footer.png') }}" alt="Footer Image">

</div>
</body>

</html>
