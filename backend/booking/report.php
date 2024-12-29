<?php
require_once '../../vendor/tcpdf/tcpdf.php';
require_once '../../classes/Database.php';
require_once '../../classes/Booking.php';
require_once '../../classes/Car.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenisLaporan = $_POST['jenis_laporan'] ?? '';
    $bulan = $_POST['bulan'] ?? '';
    $tahun = $_POST['tahun'] ?? '';

    if (!$jenisLaporan) {
        die('Jenis laporan tidak dipilih.');
    }

    $query = "";
    $params = [];

    if ($jenisLaporan === 'bulanan' && $bulan) {
        $query = "SELECT * FROM tt_bookings WHERE DATE_FORMAT(created_at, '%Y-%m') = ?";
        $params[] = $bulan;
    } elseif ($jenisLaporan === 'tahunan' && $tahun) {
        $query = "SELECT * FROM tt_bookings WHERE YEAR(created_at) = ?";
        $params[] = $tahun;
    } else {
        $_SESSION['toastr'] = [
            'type' => 'error',
            'message' => 'Failed to create car. Please try again.'
        ];
        header('Location: ../../admin/?views=transaction_list');
        exit;
    }

    $modelBooking = new Booking();
    $transactions = $modelBooking->getByQuery($query, $params);

    $pdf = new TCPDF('L');
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Company');
    $pdf->SetTitle('Laporan Transaksi');
    $pdf->SetHeaderData('', 0, 'Laporan Transaksi', '');
    $pdf->setHeaderFont(['helvetica', '', 10]);
    $pdf->setFooterFont(['helvetica', '', 8]);
    $pdf->SetMargins(15, 27, 15);
    $pdf->SetHeaderMargin(5);
    $pdf->SetFooterMargin(10);
    $pdf->SetAutoPageBreak(TRUE, 25);
    $pdf->AddPage();

    // Tambahkan konten ke PDF
    $html = '<h1 style="text-align: center;">Laporan Transaksi</h1>';

    if ($jenisLaporan === 'bulanan') {
        $html .= '<p>Bulan: ' . htmlspecialchars($bulan) . '</p>';
    } elseif ($jenisLaporan === 'tahunan') {
        $html .= '<p>Tahun: ' . htmlspecialchars($tahun) . '</p>';
    }

    $html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Booking</th>
                        <th>Mobil</th>
                        <th>Status</th>
                        <th>Harga Sewa</th>
                        <th>Denda</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>';

    if ($transactions) {
        $no = 1;
        foreach ($transactions as $transaction) {
            $modelCar = new Car();
            $car = $modelCar->getCarById($transaction['car_id']);
            $html .= '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . htmlspecialchars($transaction['no_booking']) . '</td>
                        <td>' . htmlspecialchars($car['merk']) . htmlspecialchars($car['tipe']) . '</td>
                        <td>' . htmlspecialchars($transaction['status']) . '</td>
                        <td>' . number_format($transaction['total_harga'], 0, ',', '.') . '</td>
                        <td>' . number_format($transaction['total_denda'], 0, ',', '.') . '</td>
                        <td>' . htmlspecialchars($transaction['created_at']) . '</td>
                    </tr>';
        }
    } else {
        $html .= '<tr><td colspan="6" style="text-align: center;">Tidak ada data transaksi.</td></tr>';
    }

    $html .= '</tbody></table>';

    $pdf->writeHTML($html, true, false, true, false, '');

    $namaFile = 'laporan_transaksi_' . htmlspecialchars($bulan) . htmlspecialchars($tahun) . '.pdf';

    $pdf->Output($namaFile, 'D');
}
