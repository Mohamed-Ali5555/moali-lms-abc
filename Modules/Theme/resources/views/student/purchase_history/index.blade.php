@extends('theme::layouts.master')

{{-- @extends('layouts.default') --}}

@push('title', get_phrase('Purchase History'))
@push('meta')@endpush
@push('css')@endpush
@section('content')
    <section class="wishlist-content main_content" dir="rtl">
        <div class="profile-banner-area"></div>
        <div class="container profile-banner-area-container">
            <div class="row">
                @include('theme::student.left_sidebar')

                <div class="col-lg-9">
                    <h4 class="g-title mb-5">{{ get_phrase('Payment History') }}</h4>
                    <div class="my-panel purchase-history-panel">


                        @if ($payments->count() > 0)
                            <div class="table-responsive">
                                <table class="table eTable">
                                    <thead>
                                        <tr>
                                            <th>{{ get_phrase('النوع') }}</th>
                                            <th>{{ get_phrase('الحالة') }}</th>
                                            <th>{{ get_phrase('رقم العميله') }}</th>

                                            <th>{{ get_phrase('الاجمالي') }}</th>
                                            <th>{{ get_phrase('التاريخ') }}</th>
                                            <th>{{ get_phrase('الفاتورة') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td><img height="25px" width="60px"
                                                        src="{{ get_image('assets/payment/' . $payment->payment_type . '.png') }}">
                                                </td>
                                                <td><span
                                                        class="badge @if ($payment->status == 'paid') bg-success  @else bg-primary @endif">
                                                        @if ($payment->status == 'paid')
                                                            تم التدفع
                                                        @else
                                                            قيد الانتظار
                                                        @endif
                                                </td>
                                                <td>{{ $payment->transaction_id }}</td>

                                                <td>{{ currency($payment->amount) }}</td>
                                                <td>{{ date('Y-m-d', strtotime($payment->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('theme.invoice', $payment->id) }}"
                                                        class="d-flex align-items-center justify-content-center btn btn-primary text-18 text-white"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-title="{{ get_phrase('Print Invoice') }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25px"
                                                            height="25px" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M18 13.5H18.5C19.4428 13.5 19.9142 13.5 20.2071 13.2071C20.5 12.9142 20.5 12.4428 20.5 11.5V10.5C20.5 8.61438 20.5 7.67157 19.9142 7.08579C19.3284 6.5 18.3856 6.5 16.5 6.5H7.5C5.61438 6.5 4.67157 6.5 4.08579 7.08579C3.5 7.67157 3.5 8.61438 3.5 10.5V12.5C3.5 12.9714 3.5 13.2071 3.64645 13.3536C3.79289 13.5 4.0286 13.5 4.5 13.5H6"
                                                                stroke="#FFF" />
                                                            <path
                                                                d="M6.5 19.8063L6.5 11.5C6.5 10.5572 6.5 10.0858 6.79289 9.79289C7.08579 9.5 7.55719 9.5 8.5 9.5L15.5 9.5C16.4428 9.5 16.9142 9.5 17.2071 9.79289C17.5 10.0858 17.5 10.5572 17.5 11.5L17.5 19.8063C17.5 20.1228 17.5 20.2811 17.3962 20.356C17.2924 20.4308 17.1422 20.3807 16.8419 20.2806L14.6738 19.5579C14.5878 19.5293 14.5448 19.5149 14.5005 19.5162C14.4561 19.5175 14.4141 19.5344 14.3299 19.568L12.1857 20.4257C12.094 20.4624 12.0481 20.4807 12 20.4807C11.9519 20.4807 11.906 20.4624 11.8143 20.4257L9.67005 19.568C9.58592 19.5344 9.54385 19.5175 9.49952 19.5162C9.45519 19.5149 9.41221 19.5293 9.32625 19.5579L7.15811 20.2806C6.8578 20.3807 6.70764 20.4308 6.60382 20.356C6.5 20.2811 6.5 20.1228 6.5 19.8063Z"
                                                                stroke="#FFF" />
                                                            <path d="M9.5 13.5L13.5 13.5" stroke="#FFF"
                                                                stroke-linecap="round" />
                                                            <path d="M9.5 16.5L14.5 16.5" stroke="#FFF"
                                                                stroke-linecap="round" />
                                                            <path
                                                                d="M17.5 6.5V6.1C17.5 4.40294 17.5 3.55442 16.9728 3.02721C16.4456 2.5 15.5971 2.5 13.9 2.5H10.1C8.40294 2.5 7.55442 2.5 7.02721 3.02721C6.5 3.55442 6.5 4.40294 6.5 6.1V6.5"
                                                                stroke="#FFF" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="row bg-white radius-10 mx-2">
                                <div class="com-md-12">
                                    @include('frontend.default.empty')
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            @if (count($payments) > 0)
                <div class="entry-pagination">
                    <nav aria-label="Page navigation example">
                        {{ $payments->links() }}
                    </nav>
                </div>
            @endif
            <!-- Pagination -->
        </div>
    </section>
    <!------------ purchase history area End  ------------>
@endsection
@push('js')@endpush
