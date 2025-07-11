    @extends('layouts.app')
    @section('content')
    <div class="container">
        <h3 align="center" class="mt-5">Edit Student Information</h3>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Please fix the following errors:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="form-area">
                    <form method="POST" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- This is crucial for RESTful updates --}}
                        <div class="row">
                            <div class="col-md-4 image-section">
                                <label>Current Image</label>
                                @if ($student->image)
                                    <img src="{{ asset('storage/' . $student->image) }}" alt="Current Student Image" class="img-thumbnail" style="max-width: 150px; height: auto;">
                                @else
                                    <p>No image uploaded.</p>
                                @endif
                                    <div class="mt-3">
                                        <label for="image">Update Student Image (Optional)</label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg, image/gif">
                                    </div>
                            </div>
                            <div class="col-md-8">
                                <div class="col-md-12 mb-3">
                                    <label>Student Name</label>
                                    <input type="text" class="form-control" name="stu_name" value="{{ old('stu_name', $student->stu_name) }}">
                                 </div>
                            <div class="col-md-12 mb-3">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="F" {{ old('gender', $student->gender) == 'F' ? 'selected' : '' }}>Female</option>
                                    <option value="M" {{ old('gender', $student->gender) == 'M' ? 'selected' : '' }}>Male</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Age</label>
                                <input type="number" class="form-control" name="age" value="{{ old('age', $student->age) }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="major">Major</label>
                                <select class="form-control" id="major" name="major">
                                    <option value="">Select Major</option>
                                    <option value="Khmer" {{ old('major', $student->major) == 'Khmer' ? 'selected' : '' }}>Khmer</option>
                                    <option value="ICT" {{ old('major', $student->major) == 'ICT' ? 'selected' : '' }}>ICT</option>
                                    <option value="Math" {{ old('major', $student->major) == 'Math' ? 'selected' : '' }}>Math</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <div id="course-price" class="alert alert-info" style="display:none;"></div>
                            </div>
                            <input type="hidden" id="major_price_input" name="major_price" value="{{ old('major_price', $student->major_price) }}">
                            <div class="col-md-12 mb-3">
                                <label>Enrollment Date</label>
                                <input type="date" class="form-control" name="enrollment_date" value="{{ old('enrollment_date', $student->enrollment_date) }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $student->phone) }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $student->address) }}">
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3 d-flex justify-content-end"> 
                                <input type="submit" class="btn btn-danger me-2" value="Update Student"> 
                                <a href="{{ route('students.index') }}" class="btn btn-success">Back to List</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('css')
        <style>
            .form-area {
                padding: 20px;
                margin-top: 20px;
                background-color: #b3e5fc; /* Light blue background */
                border-radius: 8px;
            }
            .image-section {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                padding-right: 15px;
            }
        </style>
    @endpush
    @push('scripts')
    <script>
    (function() {
        const majorSelect = document.getElementById('major');
        const coursePriceDiv = document.getElementById('course-price');
        const majorPriceInput = document.getElementById('major_price_input');

        const majorPrices = {
            'Khmer': 30.00,
            'ICT': 50.00,
            'Math': 40.00
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
                coursePriceDiv.style.display = 'none';
            }

            coursePriceDiv.textContent = priceToDisplay;
            majorPriceInput.value = priceToStore;
        }
        majorSelect.addEventListener('change', updateCoursePrice);
        document.addEventListener('DOMContentLoaded', function() {
            updateCoursePrice();
        });
    })();
    </script>
    @endpush
