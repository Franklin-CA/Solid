@extends('home')
@section('content')

<div id="paymentForm" class="container my-5">

    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="font-weight-bold text-white">{{ $user->name }}, Gym Timeline</h1>
        <p class="text-white-50">Set your payment details below.</p>
    </div>

    <!-- Payment Form Section -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg rounded" style="background-color: #2c2c2c; border-radius: 15px;">
                <div class="card-body" style="background-color: #333; border-radius: 15px;">
                    <form action="{{ route('admin.updatePayment', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="plan" value="{{ request('plan') }}">
                        <input type="hidden" name="amount" value="{{ request('amount') }}">

                        <!-- Paid Date Field -->
                        <div class="form-group mb-4">
                            <label for="paid_date" class="font-weight-bold text-white">Paid Date:</label>
                            <input 
                                type="date" 
                                name="paid_date" 
                                id="paid_date" 
                                class="form-control form-control-lg" 
                                value="{{ old('paid_date', date('Y-m-d')) }}" 
                                onchange="updateExpiryDate()"
                                autofocus
                            >
                            @error('paid_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Expiry Date Field -->
                        <div class="form-group mb-4">
                            <label for="expiry_date" class="font-weight-bold text-white">Expiry Date:</label>
                            <input 
                                type="date" 
                                name="expiry_date" 
                                id="expiry_date" 
                                class="form-control form-control-lg" 
                                value="{{ old('expiry_date', now()->addMonth()->format('Y-m-d')) }}" 
                                readonly
                            >
                            @error('expiry_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-dark btn-md" style="color: white; border-radius: 8px; padding: 12px 30px; font-size: 18px;">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Update expiry date automatically based on paid date
    function updateExpiryDate() {
        const paidDateInput = document.getElementById('paid_date');
        const expiryDateInput = document.getElementById('expiry_date');

        // Parse paid date and add 1 month
        const paidDate = new Date(paidDateInput.value);
        const expiryDate = new Date(paidDate);
        expiryDate.setMonth(expiryDate.getMonth() + 1);

        // Format as YYYY-MM-DD
        const formattedExpiryDate = expiryDate.toISOString().split('T')[0];

        // Set expiry date field
        expiryDateInput.value = formattedExpiryDate;
    }
</script>

@endsection
