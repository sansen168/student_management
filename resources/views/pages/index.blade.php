@extends('layouts.app')
@section('content')
    <div class="container">
         <h3 align="center" class="mt-5">Student Management</h3>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                @if (session('success'))
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div id="validation-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Please fix the following errors:
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="form-area">
                    <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Student Name</label>
                                <input type="text" class="form-control" name="stu_name" value="{{ old('stu_name') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Female</option>
                                    <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Male</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Age</label>
                                <input type="number" class="form-control" name="age" value="{{ old('age') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="major">Major</label>
                                <select class="form-control" id="major" name="major">
                                    <option value="">Select Major</option>
                                    <option value="Khmer" {{ old('major') == 'Khmer' ? 'selected' : '' }}>Khmer</option>
                                    <option value="ICT" {{ old('major') == 'ICT' ? 'selected' : '' }}>ICT</option>
                                    <option value="Math" {{ old('major') == 'Math' ? 'selected' : '' }}>Math</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <div id="course-price" class="alert alert-info" style="display:none;"></div>
                            </div>
                            <input type="hidden" id="major_price_input" name="major_price" value="{{ old('major_price') }}">

                            <div class="col-md-6 mb-3">
                                <label>Enrollment Date</label>
                                <input type="date" class="form-control" name="enrollment_date" value="{{ old('enrollment_date') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address">Address</label>
                                 <input type="text" class="form-control" name="address" id="address"  value="{{ old('address') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                 <label for="image">Student Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg, image/gif">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <input type="submit" class="btn btn-primary" value="Register">
                            </div>
                        </div>
                    </form>
            </div>
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age</th>
                            <th scope="col">Major</th>
                            <th scope="col">តម្លៃវគ្គសិក្សា</th>
                            <th scope="col">ថ្ងៃចូលរៀន</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $start_index = ($students->currentPage() - 1) * $students->perPage();
                        @endphp
                        @foreach ( $students as $key => $student )
                        <tr>
                            <td scope="col">{{ $start_index + $loop->iteration }}</td>
                            <td scope="col">{{ $student->stu_name }}</td>
                            <td scope="col">{{ $student->gender }}</td>
                            <td scope="col">{{ $student->age }}</td>
                            <td scope="col">{{ $student->major }}</td>
                            <td scope="col">${{ number_format($student->major_price, 2) ?? 'N/A' }}</td>
                            <td scope="col">{{ $student->enrollment_date }}</td>
                            <td scope="col">{{ $student->phone }}</td>
                            <td scope="col">{{ $student->address }}</td>
                            <td scope="col" class="action-column"> {{-- Added class for specific styling --}}
                                <a href="{{ route('students.show', $student->id) }}">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fa fa-eye" aria-hidden="true"></i> Show
                                    </button>
                                </a>
                                <a href="{{ route('students.edit', $student->id) }}">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                    </button>
                                </a>
                                <form action="{{route('students.destroy',$student->id)}}" method="POST" class="d-inline"> 
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mt-4">
                    {{ $students->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .form-area{
            padding: 20px;
            margin-top: 20px;
            background-color:#b3e5fc;
        }
        .bi-trash-fill{
            color:red;
            font-size: 18px;
        }
        .bi-pencil{
            color:green;
            font-size: 18px;
            margin-left: 20px;
        }
        .text-danger {
            color: #dc3545;
            font-size: 0.875em;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #f8f9fa; /* Light grey for odd rows */
        }
        .table tbody tr:nth-child(even) {
            background-color: #e9ecef; /* Slightly darker grey for even rows */
        }
        .table thead th {
            text-align: center;
            background-color:rgb(79, 133, 190); /* Custom blue for header background */
            color: #fff; /* White text for contrast */
            border-color:rgb(79, 133, 190); /* Matching border color */
        }
        .table .action-column { /* Targeted specific class for action column */
            white-space: nowrap; /* Prevent buttons from wrapping on larger screens */
            min-width: 180px;    /* Ensure enough space for 3 buttons */
            text-align: center;  /* Center buttons horizontally */
        }
        .table .action-column .btn {
            margin-right: 5px; /* Add spacing between buttons */
        }
        .table .action-column form {
            display: inline-block; /* Ensure form doesn't take full width */
            margin-right: 0;
        }
    </style>
@endpush
@push('scripts')
<script>
    (function() {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(successAlert);
                bsAlert.close();
            }, 3000);
        }
        const majorSelect = document.getElementById('major');
        const coursePriceDiv = document.getElementById('course-price');
        const majorPriceInput = document.getElementById('major_price_input');
        const majorPrices = {
            'Khmer': 30.00,
            'ICT': 50.00,
            'Math': 40.00
            // Add more majors and their prices here
        };
        function updateCoursePrice() {
            const selectedMajor = majorSelect.value;
            let priceToDisplay = '';
            let priceToStore = '';
            if (majorPrices[selectedMajor] !== undefined) {
                priceToDisplay = 'Price for ' + selectedMajor + ': $' + majorPrices[selectedMajor].toFixed(2) + ' per course';
                priceToStore = majorPrices[selectedMajor];
                coursePriceDiv.style.display = 'block';
            } else {
                priceToDisplay = '';
                priceToStore = '';
                coursePriceDiv.style.display = 'none';
            }
            coursePriceDiv.textContent = priceToDisplay;
            majorPriceInput.value = priceToStore;
        }
        majorSelect.addEventListener('change', updateCoursePrice);
        updateCoursePrice();
    })();
</script>
@endpush