<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Diana Rent Car</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      .hero {
        background: url("https://via.placeholder.com/1500x500") center/cover
          no-repeat;
        padding: 100px 0;
        color: white;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.8);
      }

      .hero-form {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      }

      .hero-form .form-control,
      .hero-form .btn {
        height: 48px;
        border-radius: 8px;
      }

      .hero h1 {
        font-weight: bold;
      }

      /* Fixed Header Form */
      .fixed-form {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: white;
        z-index: 1030;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 10px 20px;
        border-radius: 0 0 10px 10px;
      }

      .fixed-form .form-control {
        height: 40px;
      }
    </style>
  </head>
  <body>
    <!-- Hero Section -->
    <header class="hero d-flex align-items-center">
      <div class="container text-center">
        <h1>Rental Mobil di Karawang</h1>
        <div class="hero-form mt-4 mx-auto" id="heroForm">
          <form class="row g-3 align-items-center">
            <!-- Tipe Sewa -->
            <div class="col-md-2">
              <select class="form-select" required>
                <option value="">Tipe Sewa</option>
                <option value="dengan-supir">Dengan Supir</option>
                <option value="ambil-kunci">Ambil Kunci</option>
              </select>
            </div>
            <!-- Lokasi -->
            <div class="col-md-2">
              <input
                type="text"
                class="form-control"
                placeholder="Lokasi (e.g., Karawang)"
                required
              />
            </div>
            <!-- Tanggal Penjemputan -->
            <div class="col-md-3">
              <input type="date" class="form-control" required />
            </div>
            <!-- Waktu Penjemputan -->
            <div class="col-md-2">
              <input type="time" class="form-control" required />
            </div>
            <!-- Durasi -->
            <div class="col-md-2">
              <select class="form-select" required>
                <option value="">Durasi</option>
                <option value="1">1 Hari</option>
                <option value="2">2 Hari</option>
                <option value="3">3 Hari</option>
                <option value="7">1 Minggu</option>
              </select>
            </div>
            <!-- Button Cari -->
            <div class="col-md-1">
              <button type="submit" class="btn btn-primary w-100">Cari</button>
            </div>
          </form>
        </div>
      </div>
    </header>

    <!-- Content Section -->
    <section class="py-5">
      <div class="container">
        <h2 class="text-center">Selamat Datang di Rental Mobil</h2>
        <p class="text-center text-muted">
          Layanan terbaik untuk kebutuhan transportasi Anda.
        </p>
        <div class="row mt-4">
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Mobil Beragam</h5>
                <p class="card-text">
                  Berbagai pilihan mobil sesuai kebutuhan Anda.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Harga Kompetitif</h5>
                <p class="card-text">
                  Nikmati perjalanan nyaman dengan harga terjangkau.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Pelayanan Terbaik</h5>
                <p class="card-text">Prioritas kami adalah kenyamanan Anda.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Handle scroll to toggle fixed form
      const heroForm = document.getElementById("heroForm");
      const originalOffset = heroForm.offsetTop;

      window.addEventListener("scroll", () => {
        if (window.scrollY >= originalOffset) {
          heroForm.classList.add("fixed-form");
        } else {
          heroForm.classList.remove("fixed-form");
        }
      });
    </script>
  </body>
</html>
