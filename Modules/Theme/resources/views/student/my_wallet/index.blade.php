@extends('theme::layouts.master')

@push('title', get_phrase('wallet payment History'))
@push('meta')@endpush
@push('css')@endpush
@section('content')
<section class="wishlist-content main_content" dir="rtl">
    <div class="profile-banner-area"></div>
    <div class="container profile-banner-area-container">
        <div class="row">
            @include('theme::student.left_sidebar')

            {{-- سجل المعاملات --}}
            <div class="col-lg-9 wallet-transaction">
                <h4 class="g-title mb-5">{{ get_phrase('محفظتي') }}</h4>
                <div class="my-panel purchase-history-panel">
                    <div class="row align-items-center mb-3">
                        <div class="col-sm-3 mt-2">
                            <button id="wallet_charging" class="eBtn btn gradient m-0 w-100">شحن المحفظة</button>
                        </div>
                    </div>

                    @if ($user_wallets->count() > 0)
                        <div class="table-responsive">
                            <table class="table eTable">
                                <thead>
                                    <tr>
                                        <th>الرصيد</th>
                                        <th>النوع</th>
                                        <th>الكود</th>
                                        <th>رقم العملية</th>
                                        <th>الحالة</th>
                                        <th>التاريخ</th>
                                        <th>بواسطة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user_wallets as $log)
                                        <tr>
                                            <td>{{ $log->balance }}</td>
                                            <td>
                                                <img height="25px" width="60px"
                                                    src="{{ get_image('assets/payment/' . $log->type . '.png') }}">
                                            </td>
                                            <td>{{ $log->uuid }}</td>
                                            <td>{{ $log->payment_id }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($log->status == true && $log->type != 'decreased') bg-success 
                                                    @elseif($log->status == true && $log->type == 'decreased') bg-danger 
                                                    @else bg-primary @endif">
                                                    @if($log->status == true && $log->type != 'decreased')
                                                        تم الدفع
                                                    @elseif($log->status == true && $log->type == 'decreased')
                                                        تم الخصم
                                                    @else
                                                        قيد الانتظار
                                                    @endif
                                                </span>
                                            </td>
                                            <td>{{ date('Y-m-d', strtotime($log->created_at)) }}</td>
                                            <td>
                                                @if($log->student_id == $log->added_by)
                                                    الطالب
                                                @else
                                                    {{ $log->added->name }}
                                                @endif
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

            {{-- شحن المحفظة --}}
            <div class="col-lg-9 wallet-charge d-none">
                <h4 class="g-title mb-5">{{ get_phrase('شحن المحفظة') }}</h4>
                <div class="my-panel">
                    <div class="row align-items-center mb-3">
                        <div class="col-sm-3 mt-2">
                            <button id="wallet_transaction" class="eBtn btn gradient m-0 w-100">المعاملات</button>
                        </div>
                    </div>

                    <form class="form-inline" action="#" method="get">
                        @csrf
                        <div class="row align-items-center mb-3">
                            <div class="col-lg-12 mb-3">

                                {{-- المبلغ --}}
                                <div id="amount-section" class="form-group mb-3">
                                    <label for="balance" class="form-label">المبلغ :</label>
                                    <input type="number" class="form-control ol-form-control" name="balance"
                                        id="balance" style="background-color: rgba(var(--c-bg-rgb)) !important"
                                        oninput="this.value = Math.max(1, Math.abs(this.value))" required
                                        placeholder="ادخل المبلغ">
                                </div>

                                {{-- رقم الكارت --}}

                                <div id="card-section" class="wallet-card-box p-4 rounded-3 shadow-sm bg-light mt-4 d-none">
                                    <h5 class="mb-4 text-primary fw-bold text-center">
                                        <i class="fas fa-credit-card me-2"></i> شحن المحفظة بواسطة الكارت
                                    </h5>
                                
                                <div class="row mb-3">
                                    <label for="card_code" class="form-label text-dark">رقم الكارت</label>
                                    <div class="d-flex align-items-center gap-2">
                                        <input 
                                            type="number" 
                                            class="form-control ol-form-control flex-grow-1 " 
                                            name="card_code"
                                            id="card_code" 
                                            placeholder="أدخل رقم الكارت" 
                                            min="1"
                                            required 
                                            oninput="this.value = Math.max(1, Math.abs(this.value))">
                                        <button 
                                            type="button" 
                                            class="btn btn-primary m-0" 
                                            id="verify_card_btn">
                                            تحقق
                                        </button>
                                    </div>
                                </div>

                                    
                                
                                    <div class="alert mt-3 d-none" id="card_result" style="border-radius: 10px; font-weight: 500;"></div>
                                </div>
                                
                                

                                {{-- وسائل الدفع --}}
                                <div class="row text-center">
                                    @foreach ($payment_gateways as $key => $payment_gateway)
                                        <div class="col-lg-4 mt-3">
                                            <div class="payment-option card p-3 border shadow-sm rounded-3 cursor-pointer"
                                                onclick="selectPaymentGateway('{{ $payment_gateway->identifier }}')"
                                                id="{{ $payment_gateway->identifier }}-tab">
                                                <img width="75px" class="mx-auto d-block"
                                                    src="{{ get_image('assets/payment/' . $payment_gateway->identifier . '.png') }}"
                                                    alt="">
                                                <h6 class="mt-2 text-muted">
                                                    {{ ucfirst($payment_gateway->name ?? $payment_gateway->identifier) }}
                                                </h6>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- AJAX تبويب --}}
                                <div class="row mt-4">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active pb-4" id="showPaymentGatewayByAjax"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        {{-- Pagination --}}
        @if (count($user_wallets) > 0)
            <div class="entry-pagination">
                <nav aria-label="Page navigation example">
                    {{ $user_wallets->links() }}
                </nav>
            </div>
        @endif
    </div>
</section>

{{-- ========== CSS ========== --}}
<style>
.payment-option {
    transition: all 0.2s ease-in-out;
}
.payment-option.active {
    border: 2px solid #0d6efd !important;
    box-shadow: 0 0 10px rgba(13, 110, 253, 0.2);
    transform: translateY(-3px);
}
.cursor-pointer {
    cursor: pointer;
}
</style>

{{-- ========== JS ========== --}}
<script>
    // تبديل بين شحن المحفظة والمعاملات
    $('#wallet_charging').on('click', function () {
        $('.wallet-charge').removeClass('d-none');
        $('.wallet-transaction').addClass('d-none');
    });

    $('#wallet_transaction').on('click', function () {
        $('.wallet-charge').addClass('d-none');
        $('.wallet-transaction').removeClass('d-none');
    });

    // اختيار وسيلة الدفع
    function selectPaymentGateway(identifier) {
        document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('active'));
        document.getElementById(identifier + '-tab').classList.add('active');

        if (identifier === 'card') {
            document.getElementById('amount-section').classList.add('d-none');
            document.getElementById('card-section').classList.remove('d-none');
        } else {
            document.getElementById('amount-section').classList.remove('d-none');
            document.getElementById('card-section').classList.add('d-none');
            showPaymentGatewayByAjax(identifier);
        }
    }

    // تحقق من الكارت
    document.addEventListener('click', function (e) {
        if (e.target && e.target.id === 'verify_card_btn') {
            let cardCode = document.getElementById('card_code').value.trim();
            if (cardCode === '') {
                Swal.fire('تنبيه', 'من فضلك أدخل رقم الكارت', 'warning');
                return;
            }

            fetch("{{ route('theme.wallet.verify_card') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ card_code: cardCode })
            })
            .then(res => res.json())
            .then(data => {
                let result = document.getElementById('card_result');
                result.classList.remove('d-none');

                if (data.success) {
                    result.classList.add('alert-success');
                    result.classList.remove('alert-danger');
                    result.innerText = "✅ تم شحن المحفظة بمبلغ " + data.amount + " بنجاح!";
                } else {
                    result.classList.add('alert-danger');
                    result.classList.remove('alert-success');
                    result.innerText = "❌ " + data.message;
                }
            })
            .catch(err => console.error(err));
        }
    });

    // عرض وسيلة الدفع AJAX
    function showPaymentGatewayByAjax(identifier) {
        const balance = parseFloat(document.getElementById('balance').value);
        if (isNaN(balance) || balance <= 0) {
            Swal.fire({
                icon: 'warning',
                title: 'تحذير',
                text: 'من فضلك ادخل قيمة الشحن',
                confirmButtonText: 'حسناً'
            });
            return;
        }

        $('#showPaymentGatewayByAjax').html(
            '<div class="w-50 mx-auto text-center my-5"><div class="spinner-border" role="status"><span class="visually-hidden"></span></div></div>'
        );

        let urlTemplate = "{{ route('theme.wallet.show_payment_gateway_by_ajax', ['identifier' => 'IDENTIFIER', 'balance' => 'BALANCE']) }}";
        let finalUrl = urlTemplate.replace('IDENTIFIER', identifier).replace('BALANCE', balance);
        $.ajax({
            url: finalUrl,
            success(response) {
                if (identifier == "fawrypay" || identifier == "paymob") {
                    window.open(response.url, "_blank");
                }
                $('#showPaymentGatewayByAjax').html(response);
            }
        });
    }
</script>
@endsection

@push('js')@endpush
