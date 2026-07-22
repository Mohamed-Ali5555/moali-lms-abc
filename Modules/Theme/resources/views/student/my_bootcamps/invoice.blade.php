{{-- @extends('theme::layouts.master')

@push('title', get_phrase('Invoice'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/style.css') }}">
<style>
    .table-responsive {
        min-height: 250px;
    }
</style>
@endpush
@section('content')
<section class="my-course-content mt-50" style="direction: rtl;margin-top: 80px;">
    <div class="profile-banner-area"></div>
    <div class="container profile-banner-area-container">
        <div class="row">
            @include('theme::student.left_sidebar')

            <div class="col-lg-9">
                <h4 class="g-title text-capitalize">{{ get_phrase('Invoice') }}</h4>
                <div class="my-panel mt-5">
                    <div class="ol-card mb-30px">
                        <div class="col-sm-2 float-end col-md-2 p-0">
                            <a href="{{ url()->previous() }}"
                                class="eBtn gradient float-md-end"><i class="fas fa-arrow-left"></i> {{ get_phrase('Back') }}
                            </a>
                        </div>
                        <div class="ol-card-body p-20px" id="my-invoice">
                            <div class="pb-20px ol-border-bottom mb-30px">
                                <div class="mb-20px">
                                    <h5 class="title fs-16px mb-10px text-capitalize">{{ get_phrase('Invoice') }}</h5>
                                    <p class="sub-title fs-16px text-break">{{ $invoice->invoice }}</p>
                                </div>
                                <ul class="ol-list-group-2 max-w-280px">
                                    <li>
                                        <span class="title fs-16px fw-normal text-capitalize">{{ get_phrase('Issue Date') }}</span>
                                        <span class="title2 fs-16px">{{ date('d M, Y') }}</span>
                                    </li>
                                    <li>
                                        <span class="title fs-16px fw-normal text-capitalize">{{ get_phrase('Purchase Date') }}</span>
                                        <span class="title2 fs-16px">{{ date('d M, Y', strtotime($invoice->created_at)) }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="pb-20px ol-border-bottom mb-20px">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="d-flex gap-3 justify-content-between flex-wrap">
                                            <div>
                                                <h4 class="title fs-18px text-capitalize mb-20px">{{ get_phrase('Invoice To') }}</h4>
                                                @php
                                                    $user = get_user_info($invoice->user_id);
                                                @endphp
                                                <ul class="ol-list-group-2">
                                                    <li class="title fs-16px fw-normal text-capitalize">{{ $user->name }}</li>
                                                    <li class="title fs-16px fw-normal text-capitalize">{{ $user->email }}</li>
                                                    <li class="title fs-16px fw-normal text-capitalize">{{ $user->address }}</li>
                                                    <li class="title fs-16px fw-normal text-capitalize">{{ $user->phone }}</li>
                                                </ul>
                                            </div>
                                            <div class="max-w-280px w-100">
                                                <h4 class="title fs-18px text-capitalize mb-20px">{{ get_phrase('Payment Details') }}</h4>
                                                <ul class="ol-list-group-2 w-100">
                                                    <li>
                                                        <span
                                                            class="title fs-16px fw-normal text-capitalize">{{ get_phrase('Total') }}</span>
                                                        <span
                                                            class="title2 fs-16px">{{ currency($invoice->price, 2) }}</span>
                                                    </li>
                                                    <li>
                                                        <span
                                                            class="title fs-16px fw-normal text-capitalize">{{ get_phrase('Due') }}</span>
                                                        <span
                                                            class="title2 fs-16px">{{ currency($invoice->price, 2) }}</span>
                                                    </li>
                                                    <li>
                                                        <span
                                                            class="title fs-16px fw-normal text-capitalize">{{ get_phrase('Payment Method') }}</span>
                                                        <span class="title2 fs-16px text-capitalize">{{ $invoice->payment_method }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-table-wrap">
                                <!-- Table  -->
                                <div class="table-responsive">
                                    <table class="table ol-table mb-3 text-nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ get_phrase('Description') }}</th>
                                                <th scope="col" class="text-center">{{ get_phrase('Quantity') }}</th>
                                                <th scope="col" class="text-center">{{ get_phrase('Price') }}</th>
                                                <th scope="col" class="text-end">{{ get_phrase('Amount') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $invoice->title }}</td>
                                                <td class="text-center">1</td>
                                                <td class="text-center">{{ currency($invoice->price, 2) }}</td>
                                                <td class="text-end">{{ currency($invoice->price, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <a href="#" onclick="printableDiv('my-invoice');"
                                    class="btn ol-btn-light-primary ol-btn-rounded print-d-none">{{ get_phrase('Print') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    function printableDiv(printableAreaDivId) {
        var printContents = document.getElementById(printableAreaDivId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
@endpush --}}
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
                                        <span>#{{ str_pad($invoice->invoice, 5, '0', STR_PAD_LEFT) }}</span>
                                    </h2>
                                    <p class="description">
                                        {{ get_phrase('Date') }}:
                                        {{ date('d-m-Y', strtotime($invoice->created_at)) }}
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
                                                $subtotal = ($invoice->price) * ($invoice->qty ?? 1);
                                                $totalQuantity = 0;
                                            @endphp


                                                <tr>
                                                    <td>
                                                        <p>{{ $invoice->bootcamp->title ?? 'N/A' }}</p>
                                                    </td>
                                                    <td width="110px">
                                                        <p>{{ $invoice->qty ?? 1 }}</p>
                                                    </td>
                                                    <td width="110px">
                                                        <p>{{ currency($invoice->price, 2) }}</p>
                                                    </td>
                                                    <td width="110px">
                                                        <p>{{ ($invoice->price) * ($invoice->qty ?? 1)}}</p>
                                                    </td>
                                                </tr>

                                         {{--
                                            @php
                                                $couponDiscount = $subtotal - $report_historys->amount;
                                                $finalTotal = $report_historys->amount;
                                            @endphp --}}

                                            <!-- عرض المجاميع -->
                                            <tr class="">
                                                <td colspan="3" class="text-end">
                                                    <strong>{{ get_phrase('Subtotal') }}:</strong>
                                                </td>
                                                <td width="110px">
                                                    <strong>{{ currency($subtotal, 2) }}</strong>
                                                </td>
                                            </tr>

                                            {{-- @if ($couponDiscount > 0)
                                                <tr class="">
                                                    <td colspan="3" class="text-end">
                                                        <strong>{{ get_phrase('Coupon Discount') }}:</strong>
                                                    </td>
                                                    <td width="110px">
                                                        <strong>-{{ currency($couponDiscount, 2) }}</strong>
                                                    </td>
                                                </tr>
                                            @endif --}}

                                            <tr class="table-active">
                                                <td colspan="3" class="text-end">
                                                    <strong>{{ get_phrase('Final Total') }}:</strong>
                                                </td>
                                                <td width="110px">
                                                    {{-- <strong>{{ currency($finalTotal, 2) }}</strong> --}}
                                                      <strong>{{ currency($subtotal, 2) }}</strong>

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
                    <title>{{ get_phrase('Invoice') }} #{{ str_pad($invoice->invoice, 5, '0', STR_PAD_LEFT) }}</title>
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

