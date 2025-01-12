<?php
require_once '../classes/Car.php';
require_once '../classes/Booking.php';
require_once '../classes/User.php';
require_once '../classes/Payment.php';

$carModel = new Car();
$bookingModel = new Booking();
$userModel = new User();
$paymentModel = new Payment();

$currentMonth = date('m');
$currentYear = date('Y');

$startYear = 2024;

$selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('m');
$selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');

$monthsName = [
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
];

$monthName = $monthsName[$selectedMonth];

$bestCar = $carModel->bestBooking($selectedMonth, $selectedYear);

// $bestCar = $carModel->bestBooking();
$totalRevenue = $bestCar ? $carModel->getTotalRevenueForCurrentMonth($bestCar['id']) : 0;
$totalCompletedBookings = $bookingModel->getTotalCompletedBookings($selectedMonth, $selectedYear);
$totalUser = $userModel->getTotalUser();
$totalCar = $carModel->getTotalCars();
$totalAmount = $paymentModel->getTotalAmount($selectedMonth, $selectedYear);
$monthlyPayments = $paymentModel->getMonthlyPaymentsForCurrentYear($selectedYear);

$months = array_fill(1, 12, 0);
foreach ($monthlyPayments as $payment) {
    $months[(int)$payment['month']] = (float)$payment['total_amount'];
}

function formatNumber($number)
{
    if ($number >= 1000000) {
        return number_format($number / 1000000, 1) . ' juta';
    } elseif ($number >= 1000) {
        return number_format($number / 1000, 1) . ' ribu';
    } else {
        return number_format($number);
    }
}
?>
<?php if ($_SESSION['user_role'] == 'admin'): ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-6">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body text-nowrap">
                        <h6>Filter</h6>
                        <form action="index.php" method="GET">
                            <div class="row">
                                <div class="form-floating form-floating-outline col-md-3">
                                    <select class="form-select" id="month" name="month" aria-label="Bulan">
                                        <option value="" disabled>-- Pilih --</option>
                                        <option value="01" <?php echo ($selectedMonth == '01') ? 'selected' : ''; ?>>Januari</option>
                                        <option value="02" <?php echo ($selectedMonth == '02') ? 'selected' : ''; ?>>Februari</option>
                                        <option value="03" <?php echo ($selectedMonth == '03') ? 'selected' : ''; ?>>Maret</option>
                                        <option value="04" <?php echo ($selectedMonth == '04') ? 'selected' : ''; ?>>April</option>
                                        <option value="05" <?php echo ($selectedMonth == '05') ? 'selected' : ''; ?>>Mei</option>
                                        <option value="06" <?php echo ($selectedMonth == '06') ? 'selected' : ''; ?>>Juni</option>
                                        <option value="07" <?php echo ($selectedMonth == '07') ? 'selected' : ''; ?>>Juli</option>
                                        <option value="08" <?php echo ($selectedMonth == '08') ? 'selected' : ''; ?>>Agustus</option>
                                        <option value="09" <?php echo ($selectedMonth == '09') ? 'selected' : ''; ?>>September</option>
                                        <option value="10" <?php echo ($selectedMonth == '10') ? 'selected' : ''; ?>>Oktober</option>
                                        <option value="11" <?php echo ($selectedMonth == '11') ? 'selected' : ''; ?>>November</option>
                                        <option value="12" <?php echo ($selectedMonth == '12') ? 'selected' : ''; ?>>Desember</option>
                                    </select>
                                    <label for="month">Bulan <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-floating form-floating-outline col-md-3">
                                    <select class="form-select" id="year" name="year" aria-label="Tahun">
                                        <option value="" disabled>-- Pilih --</option>
                                        <?php for ($year = $startYear; $year <= $currentYear; $year++): ?>
                                            <option value="<?php echo $year; ?>" <?php echo ($selectedYear == $year) ? 'selected' : ''; ?>><?php echo $year; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <label for="year">Tahun <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-body text-nowrap">
                        <h5 class="card-title mb-0 flex-wrap text-nowrap"><?php echo htmlspecialchars($bestCar['merk'] ?? ''); ?> <?php echo htmlspecialchars($bestCar['tipe'] ?? ''); ?> 🎉</h5>
                        <p class="mb-2">Best car of the month</p>
                        <h4 class="text-primary mb-0">Rp <?php echo htmlspecialchars(number_format($totalRevenue, 2)); ?></h4>
                        <!-- <p class="mb-2">78% of target 🚀</p> -->
                        <!-- <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a> -->
                    </div>
                    <?php if ($bestCar): ?>
                        <img
                            src="../assets/uploads/car/<?php echo htmlspecialchars($bestCar['photo'] ?? ''); ?>"
                            class="position-absolute bottom-0 end-0 me-1 mb-5"
                            width="150"
                            alt="Car Photo" />
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Summary <?php echo htmlspecialchars($monthName . " " . $selectedYear) ?></h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-6">
                            <div class="col-md-6 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-primary rounded shadow-xs">
                                            <i class="ri-pie-chart-2-line ri-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-0">Transaksi</p>
                                        <h5 class="mb-0"><?php echo htmlspecialchars(number_format($totalCompletedBookings)); ?> kali</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-info rounded shadow-xs">
                                            <i class="ri-money-dollar-circle-line ri-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-0">Pendapatan</p>
                                        <h5 class="mb-0"><?php echo htmlspecialchars(formatNumber($totalAmount)); ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Data Master</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-6">
                            <div class="col-md-6 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-success rounded shadow-xs">
                                            <i class="ri-group-line ri-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-0">Pengguna</p>
                                        <h5 class="mb-0"><?php echo htmlspecialchars(number_format($totalUser)); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-warning rounded shadow-xs">
                                            <i class="ri-car-line ri-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-0">Mobil</p>
                                        <h5 class="mb-0"><?php echo htmlspecialchars(number_format($totalCar)); ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">Pendapatan Bulanan pada Tahun <?php echo htmlspecialchars($selectedYear) ?></h5>
                            <div class="dropdown">
                                <button
                                    class="btn text-muted p-0"
                                    type="button"
                                    id="weeklyOverviewDropdown"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="ri-more-2-line ri-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="weeklyOverviewDropdown">
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-lg-2">
                        <canvas id="monthlyOverviewChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('monthlyOverviewChart').getContext('2d');
        const monthlyOverviewChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Pendapatan',
                    data: <?php echo json_encode(array_values($months)); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
<?php endif; ?>