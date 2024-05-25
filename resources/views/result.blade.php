@extends ('layout.master')

@section('content')
    <!-- Hero Start -->
    <div class="container-fluid position-relative p-0">
        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Check Result</h1>
                    <a href="" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="" class="h5 text-white">Result</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Start -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let timerInterval;
            Swal.fire({
                icon: 'info',
                title: 'Data Updated!',
                html: 'The training data, testing data, and performance have been updated  due to random sampling. </br>This alert will close in <b></b> milliseconds.',
                timer: 5000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getHtmlContainer().querySelector('b');
                    timerInterval = setInterval(() => {
                        timer.textContent = Swal.getTimerLeft();
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('Alert was closed by the timer');
                }
            });
        });
    </script>

    <!-- Pesan Start -->
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <!-- Pesan End -->

    <!-- Upload Start -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-4">Upload Data</h2>
                <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 form-group">
                        <label for="file" class="form-label">Choose CSV File</label>
                        <input type="file" name="file" class="form-control" id="file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Upload End -->

    <!-- Akurasi Start -->
    <!-- Training Data Start -->
    <div class="container mt-5">
        <div class="card card-responsive">
            <div class="card-header bg-primary d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                data-bs-target="#accuracyCollapse" aria-expanded="false" aria-controls="accuracyCollapse">
                <h2 class="mb-0 d-inline">Data Performance</h2>
                <div>
                    <i class="fas fa-chevron-down ms-1"></i>
                </div>
            </div>
            <div id="accuracyCollapse" class="collapse">
                <div class="card-body">
                    <h3>Performance Metrics:</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Metric</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Accuracy</td>
                                    <td>{{ $accuracy }}</td>
                                </tr>
                                <tr>
                                    <td>Precision</td>
                                    <td>{{ $precision }}</td>
                                </tr>
                                <tr>
                                    <td>Recall</td>
                                    <td>{{ $recall }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Confusion Matrix:</h3>
                    <div class="confusion-matrix">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th></th>
                                        <th>Predicted Negative</th>
                                        <th>Predicted Positive</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Actual Negative</strong></td>
                                        <td class="text-center">{{ $confusionMatrix[0][0] }}</td>
                                        <!-- True Negative (TN) -->
                                        <td class="text-center">{{ $confusionMatrix[0][1] }}</td>
                                        <!-- False Positive (FP) -->
                                    </tr>
                                    <tr>
                                        <td><strong>Actual Positive</strong></td>
                                        <td class="text-center">{{ $confusionMatrix[1][0] }}</td>
                                        <!-- False Negative (FN) -->
                                        <td class="text-center">{{ $confusionMatrix[1][1] }}</td>
                                        <!-- True Positive (TP) -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testing Data Start -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                data-bs-target="#testingCollapse" aria-expanded="false" aria-controls="testingCollapse">
                <h2 class="mb-0 d-inline">Data Testing</h2>
                <div>
                    <i class="fas fa-chevron-down ms-1"></i>
                </div>
            </div>
            <div id="testingCollapse" class="collapse">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="table-primary">
                                    <th scope="col">No.</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Impulse</th>
                                    <th scope="col">Pressure High</th>
                                    <th scope="col">Pressure Low</th>
                                    <th scope="col">Glucose</th>
                                    <th scope="col">KCM</th>
                                    <th scope="col">Troponin</th>
                                    <th scope="col">Result</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($trainingData as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data['age'] }}</td>
                                        <td>{{ $data['gender'] }}</td>
                                        <td>{{ $data['impulse'] }}</td>
                                        <td>{{ $data['pressurehight'] }}</td>
                                        <td>{{ $data['pressurelow'] }}</td>
                                        <td>{{ $data['glucose'] }}</td>
                                        <td>{{ $data['kcm'] }}</td>
                                        <td>{{ $data['troponin'] }}</td>
                                        <td>{{ $data['class'] }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Training Data Start -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                data-bs-target="#trainingCollapse" aria-expanded="false" aria-controls="trainingCollapse">
                <h2 class="mb-0 d-inline">Data Training</h2>
                <div>
                    <i class="fas fa-chevron-down ms-1"></i>
                </div>
            </div>
            <div id="trainingCollapse" class="collapse">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="table-primary">
                                    <th scope="col">No.</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Impulse</th>
                                    <th scope="col">Pressure High</th>
                                    <th scope="col">Pressure Low</th>
                                    <th scope="col">Glucose</th>
                                    <th scope="col">KCM</th>
                                    <th scope="col">Troponin</th>
                                    <th scope="col">Result</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($testingData as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data['age'] }}</td>
                                        <td>{{ $data['gender'] }}</td>
                                        <td>{{ $data['impulse'] }}</td>
                                        <td>{{ $data['pressurehight'] }}</td>
                                        <td>{{ $data['pressurelow'] }}</td>
                                        <td>{{ $data['glucose'] }}</td>
                                        <td>{{ $data['kcm'] }}</td>
                                        <td>{{ $data['troponin'] }}</td>
                                        <td>{{ $data['class'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Original Data Start -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary d-flex justify-content-between align-items-center"
                data-bs-toggle="collapse" data-bs-target="#dataCollapse" aria-expanded="false"
                aria-controls="dataCollapse">
                <h2 class="mb-0 d-inline">Data Original</h2>
                <div>
                    <i class="fas fa-chevron-down ms-1"></i>
                </div>
            </div>
            <div id="dataCollapse" class="collapse">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="table-primary">
                                    <th scope="col">No.</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Impulse</th>
                                    <th scope="col">Pressure High</th>
                                    <th scope="col">Pressure Low</th>
                                    <th scope="col">Glucose</th>
                                    <th scope="col">KCM</th>
                                    <th scope="col">Troponin</th>
                                    <th scope="col">Result</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($heartData as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->age }}</td>
                                        <td>{{ $data->gender }}</td>
                                        <td>{{ $data->impulse }}</td>
                                        <td>{{ $data->pressurehight }}</td>
                                        <td>{{ $data->pressurelow }}</td>
                                        <td>{{ $data->glucose }}</td>
                                        <td>{{ $data->kcm }}</td>
                                        <td>{{ $data->troponin }}</td>
                                        <td>{{ $data->class }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $data->id }})">Delete</button>
                                            <form id="deleteForm_{{ $data->id }}"
                                                action="{{ route('result.destroy', $data->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $heartData->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Table Data End -->

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm_' + id).submit();
                }
            });
        }
    </script>

@endsection
