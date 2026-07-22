@extends('theme::layouts.master')

@push('title', get_phrase('Invoice'))

@section('content')
    <section class="wishlist-content main_content" dir="rtl">
        <div class="profile-banner-area"></div>
        <div class="container profile-banner-area-container">
            <div class="row">
                @include('theme::student.left_sidebar')

                <div class="col-lg-9">
                    <h4 class="g-title mb-5">{{ get_phrase('Invoice') }}</h4>
                    <div class="my-panel purchase-history-panel">
                        <div class="invoice mt-5" id="invoice">
                            <div
                                class="top d-flex justify-content-between align-items-center pb-5 mb-5 border-1 border-bottom">
                                <div>
                                    <h2>
                                        <span>{{ get_phrase('Invoice') }}</span>
                                        <span>#{{ str_pad($report_historys->invoice, 5, '0', STR_PAD_LEFT) }}</span>
                                    </h2>
                                    <p class="description">
                                        {{ get_phrase('Date') }}:
                                        {{ date('d-m-Y', strtotime($report_historys->created_at)) }}
                                    </p>
                                </div>
                                <div>


                                    <img src="{{ get_image(get_theme_settings('logo') ?? '') }}" class="logo light"
                                        alt="system logo" width="200px" />
                                    <img src="{{ get_image(get_theme_settings('dark_logo') ?? '') }}" class="logo dark"
                                        alt="system logo" width="200px" />
                                </div>
                            </div>

                            <div class="billing-area">
                                <div class="table-responsive">
                                    <table class="table eTable">
                                        <thead>
                                            <tr>
                                                <th>{{ get_phrase('Item') }}</th>
                                                <th>{{ get_phrase('Qty') }}</th>
                                                <th>{{ get_phrase('Price') }}</th>
                                                <th>{{ get_phrase('Total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $subtotal = 0;
                                                $totalQuantity = 0;
                                            @endphp

                                            @foreach ($invoice_items as $invoice)
                                                @php
                                                    $itemPrice =
                                                        $invoice->item->discount_price > 0
                                                            ? $invoice->item->discount_price
                                                            : $invoice->item->price;
                                                    $itemTotal = $invoice->qty * $itemPrice;
                                                    $subtotal += $itemTotal;
                                                    $totalQuantity += $invoice->qty;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <p>{{ $invoice->item->title ?? 'N/A' }}</p>
                                                    </td>
                                                    <td width="110px">
                                                        <p>{{ $invoice->qty }}</p>
                                                    </td>
                                                    <td width="110px">
                                                        <p>{{ currency($itemPrice, 2) }}</p>
                                                    </td>
                                                    <td width="110px">
                                                        <p>{{ currency($itemTotal, 2) }}</p>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            @php
                                                $couponDiscount = $subtotal - $report_historys->amount;
                                                $finalTotal = $report_historys->amount;
                                            @endphp

                                            <!-- عرض المجاميع -->
                                            <tr class="">
                                                <td colspan="3" class="text-end">
                                                    <strong>{{ get_phrase('Subtotal') }}:</strong>
                                                </td>
                                                <td width="110px">
                                                    <strong>{{ currency($subtotal, 2) }}</strong>
                                                </td>
                                            </tr>

                                            @if ($couponDiscount > 0)
                                                <tr class="">
                                                    <td colspan="3" class="text-end">
                                                        <strong>{{ get_phrase('Coupon Discount') }}:</strong>
                                                    </td>
                                                    <td width="110px">
                                                        <strong>-{{ currency($couponDiscount, 2) }}</strong>
                                                    </td>
                                                </tr>
                                            @endif

                                            <tr class="table-active">
                                                <td colspan="3" class="text-end">
                                                    <strong>{{ get_phrase('Final Total') }}:</strong>
                                                </td>
                                                <td width="110px">
                                                    <strong>{{ currency($finalTotal, 2) }}</strong>
                                                </td>
                                            </tr>

                                            <!-- معلومات الفاتورة -->
                                            <tr>
                                                <td colspan="4">
                                                    <p class="description mb-2">
                                                        <strong>{{ get_phrase('Billed to') }}:</strong></p>
                                                    <p class="mb-0">{{ auth()->user()->name }}</p>
                                                    <p class="mb-0">{{ auth()->user()->email ?? '' }}</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-end gap-3 mt-3">
                        <a class="eBtn gradient" href="{{ route('theme.purchase.history') }}">
                            {{ get_phrase('Back') }}
                        </a>
                        <a class="eBtn gradient" id="print" href="javascript:void(0);"
                            onclick="printableDiv('invoice')">
                            {{ get_phrase('Print') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

    <script>


        function printableDiv(printableAreaDivId) {
            // حفظ المحتوى الأصلي
            const originalContents = document.body.innerHTML;

            // الحصول على محتوى المنطقة القابلة للطباعة
            const printContents = document.getElementById(printableAreaDivId).innerHTML;

            // تعيين محتوى جديد للجسم للطباعة فقط
            document.body.innerHTML = `
            <html>
                <head>
                    <title>{{ get_phrase('Invoice') }} #{{ str_pad($report_historys->invoice, 5, '0', STR_PAD_LEFT) }}</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        .table { width: 100%; border-collapse: collapse; }
                        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        .table th { background-color: #f8f9fa; }
                        .text-end { text-align: right; }
                        .table-active { background-color: #e9ecef; }
                        .border-bottom { border-bottom: 2px solid #000; }
                        .description { color: #6c757d; }
                    </style>
                </head>
                <body>${printContents}</body>
            </html>
        `;

            // طباعة المحتوى
            window.print();

            // استعادة المحتوى الأصلي
            document.body.innerHTML = originalContents;

            // إعادة تحميل الأحداث إذا لزم الأمر
            window.location.reload();
        }
    </script>
