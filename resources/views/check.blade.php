@extends ('layout.master')

@section('content')
    <!-- Hero Start -->
    <div class="container-fluid position-relative p-0">
        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Heart Check</h1>
                    <a href="/" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="/check" class="h5 text-white">Heart Check</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Start -->

    <!-- Check Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Check Heart Health</h5>
                <h1 class="mb-0">Choose CardioCheck to Monitor Your Heart</h1>
            </div>
            <p class="mb-4 text-center">Metode Naive Bayes adalah algoritma klasifikasi dalam machine learning yang
                didasarkan pada teorema Bayes.
                Algoritma ini menggunakan probabilitas untuk menganalisis hubungan antara faktor-faktor risiko dengan
                kemungkinan penyakit jantung. Keunggulan Naive Bayes terletak pada kesederhanaannya, mengasumsikan bahwa
                setiap fitur independen satu sama lain. Meskipun asumsi ini tidak selalu akurat, Naive Bayes sering
                memberikan hasil yang baik. Algoritma ini efisien, cepat dalam menganalisis data besar, mudah
                diimplementasikan, dan memerlukan sedikit data pelatihan.
                Dalam prediksi penyakit jantung, Naive Bayes memanfaatkan data kesehatan pengguna untuk menghasilkan
                prediksi yang akurat, menjadikannya pilihan kuat untuk aplikasi kami.</p>
            <div class="p-3 text-center">
                <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Tambah Data</a>
            </div>
        </div>
    </div>
    <!-- Check End -->
@endsection
