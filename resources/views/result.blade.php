@extends('layout.master')

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
    <!-- Hero End -->

    <!-- Upload Start -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-4">Upload Data</h2>

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

    <!-- Training Data Start -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary" data-bs-toggle="collapse" data-bs-target="#trainingCollapse" aria-expanded="false"
                aria-controls="trainingCollapse">
                <h2 class="mb-0 d-inline">Data Training</h2>
                <i class="fas fa-chevron-down float-end"></i>
            </div>
            <div id="trainingCollapse" class="collapse">
                <div class="card-body">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Training Data End -->

    <!-- Testing Data Start -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary" data-bs-toggle="collapse" data-bs-target="#testingCollapse" aria-expanded="false"
                aria-controls="testingCollapse">
                <h2 class="mb-0 d-inline">Data Testing</h2>
                <i class="fas fa-chevron-down float-end"></i>
            </div>
            <div id="testingCollapse" class="collapse">
                <div class="card-body">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Testing Data End -->

    <!-- Klasifikasi Start -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary" data-bs-toggle="collapse" data-bs-target="#classificationCollapse"
                aria-expanded="false" aria-controls="classificationCollapse">
                <h2 class="mb-0 d-inline">Klasifikasi</h2>
                <i class="fas fa-chevron-down float-end"></i>
            </div>
            <div id="classificationCollapse" class="collapse">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">#</th>
                                <th scope="col">true negative</th>
                                <th scope="col">true positive</th>
                                <th scope="col">class precision</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td scope="row">pred. negative</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td scope="row">pred. positive</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td scope="row">class recall</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Klasifikasi End -->

    <!-- Table Data Start -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary" data-bs-toggle="collapse" data-bs-target="#originalDataCollapse"
                aria-expanded="false" aria-controls="originalDataCollapse">
                <h2 class="mb-0 d-inline">Data Original</h2>
                <i class="fas fa-chevron-down float-end"></i>
            </div>
            <div id="originalDataCollapse" class="collapse">
                <div class="card-body">
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $heartData->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Table Data End -->
@endsection
