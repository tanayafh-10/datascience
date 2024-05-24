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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Cek Kondisimu
                </button>
            </div>
        </div>
    </div>
    <!-- Check End -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cek Kondisi Jantung Anda Sekarang!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/check') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 ms-auto">
                                <div class="mb-3">
                                    <label for="age" class="form-label">Age *</label>
                                    <input type="text" class="form-control" id="age" placeholder="Insert Your Age"
                                        required>
                                    <div class="invalid-feedback">Please provide your age.</div>
                                </div>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender *</label>
                                    <div class="row">
                                        <div class="col-8 col-sm-6 ms-auto">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="genderFemale" value="0" required>
                                                <label class="form-check-label" for="genderFemale">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-6 ms-auto">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="genderMale" value="1" required>
                                                <label class="form-check-label" for="genderMale">
                                                    Male
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="impulse" class="form-label">Impulse *</label>
                            <input type="text" class="form-control" id="impulse"
                                placeholder="Insert your Heart Rate. (e.g. '94')" required>
                            <div class="invalid-feedback">Please provide your heart rate.</div>
                        </div>
                        <div class="mb-3">
                            <label for="pressurehight" class="form-label">Pressure Hight *</label>
                            <input type="text" class="form-control" id="pressurehight"
                                placeholder="Insert your Systolic Blood Pressure. (e.g., '120')" required>
                            <div class="invalid-feedback">Please provide your systolic blood pressure.</div>
                        </div>
                        <div class="mb-3">
                            <label for="pressurelow" class="form-label">Pressure Low *</label>
                            <input type="text" class="form-control" id="pressurelow"
                                placeholder="Insert your Diastolic Blood Pressure. (e.g., '80')" required>
                            <div class="invalid-feedback">Please provide your diastolic blood pressure.</div>
                        </div>
                        <div class="mb-3">
                            <label for="glucose" class="form-label">Glucose *</label>
                            <input type="text" class="form-control" id="glucose"
                                placeholder="Insert your Blood Sugar. (e.g., '100')" required>
                            <div class="invalid-feedback">Please provide your blood sugar level.</div>
                        </div>
                        <div class="mb-3">
                            <label for="kcm" class="form-label">KCM *</label>
                            <input type="text" class="form-control" id="kcm"
                                placeholder="Insert your CK-MB test result. (e.g., '3.43')" required>
                            <div class="invalid-feedback">Please provide your CK-MB test result.</div>
                        </div>
                        <div class="mb-3">
                            <label for="troponin" class="form-label">Troponin *</label>
                            <input type="text" class="form-control" id="troponin"
                                placeholder="Insert your Troponin test result. (e.g., '0.012')" required>
                            <div class="invalid-feedback">Please provide your troponin test result.</div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                            <label class="form-check-label" for="exampleCheck1">Are you sure the data is correct?
                                *</label>
                            <div class="invalid-feedback">Please confirm the correctness of your data.</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="handleSubmit(event)">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tampilkan notifikasi hasil prediksi -->
    @if (isset($result))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Hasil Prediksi',
            text: 'Label yang diprediksi: {{ $result }}',
        });
    </script>
    @endif

    {{-- <script>
        function handleSubmit(event) {
            event.preventDefault();

            // Get the form element
            var form = document.getElementById('heartCheckForm');

            // Check if the form is valid
            if (form.checkValidity() === false) {
                // If the form is not valid, show browser's validation message
                form.reportValidity();
                return;
            }

            // Close the modal
            var myModalEl = document.getElementById('exampleModal');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();

            // Show loading message
            Swal.fire({
                title: 'Processing',
                text: 'Your check result is being processed...',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            // Simulate processing delay (10 seconds)
            setTimeout(function() {
                // Close the loading message
                Swal.close();

                // Show the SweetAlert2 popup after the modal is hidden
                myModalEl.addEventListener('hidden.bs.modal', function() {
                    Swal.fire({
                        title: 'Negative!',
                        text: 'Berdasarkan hasil pengecekan jantung Anda, tidak ada masalah yang ditemukan. Jantung Anda berada dalam kondisi yang baik dan sehat. Teruslah menjaga gaya hidup sehat dan lakukan pemeriksaan rutin untuk tetap memastikan kesehatan jantung Anda tetap prima.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#06A3DA'
                    });
                }, {
                    once: true
                });

                // Trigger the hidden.bs.modal event to ensure the success popup appears after the modal is closed
                myModalEl.dispatchEvent(new Event('hidden.bs.modal'));
            }, 5000); // 5 seconds delay
        }
    </script> --}}
@endsection
