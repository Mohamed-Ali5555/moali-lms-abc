@extends('theme::layouts.master')
@section('content')
<section class="checkout-page-section" dir="rtl">
    <div class="section-background-aurora">
        <div class="animated-blob blob-1"></div>
        <div class="animated-blob blob-2"></div>
    </div>

    <div class="container" style="position: relative; z-index: 2">
        <h1 class="page-title">{{ get_phrase('إتمام عملية الدفع') }}</h1>
        <div class="row g-4">
            <!-- ✅ ملخص الطلب -->
            <div class="col-lg-5">
                <div class="glass-panel">
                    <h4 class="panel-title">ملخص الطلب</h4>

                    {{-- عرض العناصر --}}
                    @foreach ($payment_details['items'] as $item)
                        <div class="order-summary-item">
                            <span class="item-name">
                                {{ $item['title'] }}
                                @if (isset($item['qty'])) (x{{ $item['qty'] }}) @endif
                            </span>
                            <span class="item-total">
                                {{ currency($item['discount_price'] > 0 ? $item['discount_price'] * ($item['qty'] ?? 1) : $item['price'] * ($item['qty'] ?? 1), 2) }}
                            </span>
                        </div>
                    @endforeach

                    {{-- الإجمالي --}}
                    <div class="order-summary-item grand-total">
                        <span>{{ get_phrase('الإجمالي النهائي') }}</span>
                        <span>{{ currency($payment_details['payable_amount'], 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- ✅ طرق الدفع -->
            <div class="col-lg-7">
                <div class="glass-panel">
                    <h4 class="panel-title">اختر طريقة الدفع</h4>
                    <div class="payment-methods" role="tablist" aria-orientation="vertical">
                        @foreach ($payment_gateways as $payment_gateway)
                            <div class="tabItem payment-method-card"
                                onclick="showPaymentGatewayByAjax('{{ $payment_gateway->identifier }}')"
                                id="{{ $payment_gateway->identifier }}-tab"
                                data-bs-toggle="pill"
                                data-bs-target="#{{ $payment_gateway->identifier }}" role="tab"
                                aria-controls="{{ $payment_gateway->identifier }}" aria-selected="true">
                                <img src="{{ asset('assets/payment/' . $payment_gateway->identifier . '.png') }}"
                                     alt="{{ $payment_gateway->title }}" />
                                <span>{{ $payment_gateway->title }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="payment-form-container mt-4" id="payment-form-container">
                        <div id="showPaymentGatewayByAjax" class="tab-pane fade show active text-end pb-4">
                            <h2 class="pt-4 text-center mb-0">برجاء اختيار طريقة الدفع</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

{{-- ✅ سكربت عرض طرق الدفع --}}
<script type="text/javascript">
    function showPaymentGatewayByAjax(identifier) {
        $('#showPaymentGatewayByAjax').html(
            '<div class="w-100 text-center my-5"><div class="spinner-border" role="status"><span class="visually-hidden"></span></div></div>'
        );

        if (identifier === 'card') {
            // 🪪 طريقة الدفع بالكارت
            $('#showPaymentGatewayByAjax').html(`
                <div class="text-center pt-4">
                    <h5 class="fw-bold mb-3"><i class="fi fi-rr-credit-card"></i> شراء بواسطة الكارت</h5>
                    <div class="mx-auto" style="max-width: 420px;">
                        <div class="form-group mb-3 text-end">
                            <label for="card_code" class="form-label fw-semibold">رقم الكارت</label>
                            <div class="input-group">
                                <input type="number" class="form-control py-2" id="card_code" placeholder="أدخل رقم الكارت" required>
                                <button type="button" class="btn btn-primary fw-semibold px-4" id="verify_card_btn">تحقق</button>
                            </div>
                            <div class="alert mt-3 d-none" id="card_result"></div>
                        </div>
                    </div>
                </div>
            `);

        } else {
            // باقي طرق الدفع
            $.ajax({
                url: "{{ route('payment.show_payment_gateway_by_ajax', '') }}/" + identifier,
                success(response) {
                    if(response.status == false){
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: response.message,
                            confirmButtonText: 'حسناً'
                        });
                    }else{
                        if (identifier === "fawrypay" || identifier === "paymob") {
                            window.open(response.url, "_blank");
                        }
                        $('#showPaymentGatewayByAjax').html(response);
                    }

                }
            });
        }
    }

    // 🧾 تحقق من الكارت
    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'verify_card_btn') {
            let cardCode = document.getElementById('card_code').value.trim();
            if (cardCode === '') {
                alert('من فضلك أدخل رقم الكارت');
                return;
            }

            fetch("{{ route('payment.verify_card') }}", {
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
                    document.getElementById('verify_card_btn').disabled = true;
                    document.getElementById('verify_card_btn').innerHTML = 'تم التحقق';
                    result.classList.add('alert-success');
                    result.classList.remove('alert-danger');
                    result.innerText = "✅ تم دفع الفاتورة بمبلغ " + data.amount + " بنجاح!";
                } else {
                    result.classList.add('alert-danger');
                    result.classList.remove('alert-success');
                    result.innerText = "❌ " + data.message;
                }
                setTimeout(() => {
                    window.location.href = "{{ route('theme.my.courses') }}";
                }, 3000);
            })
            .catch(err => console.error(err));
        }
    });
</script>
@endsection
