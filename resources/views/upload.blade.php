@extends ('layout.master')

@section('content')
    <!-- Hero Start -->
    <div class="container-fluid position-relative p-0">
        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Upload Dataset</h1>
                    <a href="/" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="/upload" class="h5 text-white">Upload</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Start -->

    <!-- Upload Start -->
    <div class="container-fluid mt-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Upload Your Dataset</h5>
                <h1 class="mb-0">Make Sure to Upload a Dataset Before Opening the Results Page</h1>
            </div>
        </div>
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
@endsection
