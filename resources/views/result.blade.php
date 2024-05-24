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

    {{-- Tampilan Notifikasi --}}
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

    <!-- Table Data Start -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary d-flex justify-content-between align-items-center"
             data-bs-toggle="collapse" data-bs-target="#testingCollapse" aria-expanded="false" aria-controls="testingCollapse">
                <h2 class="mb-0 d-inline">Data Original</h2>
                <form action="{{ url('/result') }}" 
                style="color: black" method="POST">
                    @csrf
                    <button class="btn btn-transparent me-1" style="border-radius: 10px;" 
                    onmouseover="this.style.backgroundColor='#AFAFAF';" 
                    onmouseout="this.style.backgroundColor='transparent';" type="submit">Train</button>
                </form>
                <div>
                    <button class="btn btn-transparent ms-1" data-bs-toggle="modal" data-bs-target="#createModal"
                     style="border-radius: 10px;" onmouseover="this.style.backgroundColor='#AFAFAF';" 
                     onmouseout="this.style.backgroundColor='transparent';">Add New</button>
                    <i class="fas fa-chevron-down ms-1"></i>
                </div>
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
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($heartData as $index => $data)
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
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}">Edit</button>
                                        <form action="{{ route('result.destroy', $data->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $data->id }}">Edit Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('result.update', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3 form-group">
                                                        <label for="age" class="form-label">Age</label>
                                                        <input type="number" name="age" class="form-control" id="age{{ $data->id }}" value="{{ $data->age }}" required>
                                                    </div>
                                                    <div class="mb-3 form-group">
                                                        <label for="gender" class="form-label">Gender</label>
                                                        <input type="text" name="gender" class="form-control" id="gender{{ $data->id }}" value="{{ $data->gender }}" required>
                                                    </div>
                                                    <div class="mb-3 form-group">
                                                        <label for="impulse" class="form-label">Impulse</label>
                                                        <input type="number" name="impulse" class="form-control" id="impulse{{ $data->id }}" value="{{ $data->impulse }}" required>
                                                    </div>
                                                    <div class="mb-3 form-group">
                                                        <label for="pressurehight" class="form-label">Pressure High</label>
                                                        <input type="number" name="pressurehight" class="form-control" id="pressurehight{{ $data->id }}" value="{{ $data->pressurehight }}" required>
                                                    </div>
                                                    <div class="mb-3 form-group">
                                                        <label for="pressurelow" class="form-label">Pressure Low</label>
                                                        <input type="number" name="pressurelow" class="form-control" id="pressurelow{{ $data->id }}" value="{{ $data->pressurelow }}" required>
                                                    </div>
                                                    <div class="mb-3 form-group">
                                                        <label for="glucose" class="form-label">Glucose</label>
                                                        <input type="number" name="glucose" class="form-control" id="glucose{{ $data->id }}" value="{{ $data->glucose }}" required>
                                                    </div>
                                                    <div class="mb-3 form-group">
                                                        <label for="kcm" class="form-label">KCM</label>
                                                        <input type="number" name="kcm" class="form-control" step="0.01" id="kcm{{ $data->id }}" value="{{ $data->kcm }}" required>
                                                    </div>
                                                    <div class="mb-3 form-group">
                                                        <label for="troponin" class="form-label">Troponin</label>
                                                        <input type="number" name="troponin" class="form-control" step="0.001" id="troponin{{ $data->id }}" value="{{ $data->troponin }}" required>
                                                    </div>
                                                    <div class="mb-3 form-group">
                                                        <label for="class" class="form-label">Result</label>
                                                        <input type="text" name="class" class="form-control" id="class{{ $data->id }}" value="{{ $data->class }}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $heartData->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Table Data End -->

    <!-- Create Modal -->
    {{-- <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add New Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('result.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" class="form-control" id="age" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="gender" class="form-label">Gender</label>
                            <input type="text" name="gender" class="form-control" id="gender" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="impulse" class="form-label">Impulse</label>
                            <input type="number" name="impulse" class="form-control" id="impulse" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="pressurehight" class="form-label">Pressure High</label>
                            <input type="number" name="pressurehight" class="form-control" id="pressurehight" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="pressurelow" class="form-label">Pressure Low</label>
                            <input type="number" name="pressurelow" class="form-control" id="pressurelow" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="glucose" class="form-label">Glucose</label>
                            <input type="number" name="glucose" class="form-control" id="glucose" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="kcm" class="form-label">KCM</label>
                            <input type="number" name="kcm" step="0.01" class="form-control" id="kcm" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="troponin" class="form-label">Troponin</label>
                            <input type="number" name="troponin" step="0.001" class="form-control" id="troponin" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="class" class="form-label">Result</label>
                            <input type="text" name="class" class="form-control" id="class" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
