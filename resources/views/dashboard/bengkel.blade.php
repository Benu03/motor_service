<!-- Info Boxes Section -->
<div class="row">
    <!-- Service Box -->
    <div class="col-12 col-sm-6 col-md-3 mb-3">
        <a href="{{ route('service-list-bengkel') }}" class="text-decoration-none">
            <div class="info-box shadow-sm rounded bg-white h-100 hover-shadow transition">
                <span class="info-box-icon bg-info text-white elevation-1 rounded-start d-flex align-items-center justify-content-center">
                    <i class="fas fa-motorcycle fa-lg"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text text-dark">Service</span>
                    <span class="info-box-number text-dark fw-bold">
                        {{ $service }}
                        <small class="text-muted">Waiting</small>
                    </span>
                </div>
            </div>
        </a>
    </div>

    <!-- Direct Service Box -->
    <div class="col-12 col-sm-6 col-md-3 mb-3">
        <a href="{{ route('service-list-bengkel') }}" class="text-decoration-none">
            <div class="info-box shadow-sm rounded bg-white h-100 hover-shadow transition">
                <span class="info-box-icon bg-warning text-white elevation-1 rounded-start d-flex align-items-center justify-content-center">
                    <i class="fas fa-directions fa-lg"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text text-dark">Direct Service</span>
                    <span class="info-box-number text-dark fw-bold">{{ $direct }}</span>
                </div>
            </div>
        </a>
    </div>

    <!-- Invoice Box -->
    <div class="col-12 col-sm-6 col-md-3 mb-3">
        <a href="{{ route('invoice') }}" class="text-decoration-none">
            <div class="info-box shadow-sm rounded bg-white h-100 hover-shadow transition">
                <span class="info-box-icon bg-danger text-white elevation-1 rounded-start d-flex align-items-center justify-content-center">
                    <i class="fas fa-money-check fa-lg"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text text-dark">Invoice</span>
                    <span class="info-box-number text-dark fw-bold">{{ $invoice }}</span>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Optional style for hover effect -->
<style>
    .info-box:hover {
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15) !important;
        transform: translateY(-2px);
        transition: all 0.2s ease-in-out;
    }
</style>
