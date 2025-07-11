@extends('layouts.app')
@section('content')
<style>
    /* Custom styles to match the provided image */
    .student-details-container {
        /* border: 2px solid #b3e5fc;  */
        /* Light blue border for the main container */
        padding: 2rem;
        border-radius: 10px;
        background-color: #b3e5fc;
    }
    .image-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        padding-right: 15px; /* Add some padding to separate from details on larger screens */
    }
    
    .student-name-display { /* Renamed for clarity, was student-name */
        font-size: 1.25rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 1.5rem; /* Space below name before details */
        word-wrap: break-word; /* Allow long names to wrap */
    }
    .details-section {
        border: 1px solid #0dcaf0; /* Light blue border for details section */
        padding: 1.5rem;
        border-radius: 5px;
        /* For small screens, ensure it stacks below image properly */
        margin-top: 1rem; /* Space from image section on small screens */
    }
    .detail-item {
        display: flex;
        align-items: baseline; /* Align items to their baselines */
        margin-bottom: 1rem;
        flex-wrap: wrap; /* <== IMPORTANT: Allow label and value to wrap on new line on small screens */
    }
    .detail-item label {
        font-weight: bold;
        flex-basis: 120px; /* <== Initial width for labels on larger screens */
        text-transform: capitalize;
        padding-right: 10px; /* Space between label and value */
        white-space: nowrap; /* Keep label on one line if possible */
    }
    .detail-value {
        flex-grow: 1; /* <== Allow value to take remaining space */
        border: 1px solid #b3e5fc; /* Light blue border for fields */
        padding: 0.375rem 0.75rem;
        border-radius: 5px;
        background-color: #f8f9fa;
        min-height: 38px;
        word-wrap: break-word; /* Ensure long values wrap */
    }
    .action-buttons {
        text-align: right;
        margin-top: 1.5rem;
    }
    

</style>
<div class="container mt-4">
    <h3 align="center" class="mb-4">Student Details</h3>
    <div class="col-md-8 offset-md-2 student-details-container">
        <div class="row">
            <div class="col-md-4 image-section">
                    @if ($student->image)
                        <img src="{{ asset('storage/' . $student->image) }}" alt="Student Image" class="img-thumbnail" style="max-width: 150px; height: auto;">
                    @else
                       <p>No image uploaded.</p>
                    @endif
                <div class="student-name-display">{{ $student->stu_name }}</div>
            </div>
            <div class="col-md-8">
                <div class="details-section">
                    <div class="detail-item">
                        <label>Gender</label>
                        <div class="detail-value">{{ $student->gender == 'F' ? 'Female' : 'Male' }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Age</label>
                        <div class="detail-value">{{ $student->age }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Major</label>
                        <div class="detail-value">{{ $student->major }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Price</label>
                        <div class="detail-value">${{ number_format($student->major_price, 2) ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Date</label>
                        <div class="detail-value">{{ $student->enrollment_date }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Phone</label>
                        <div class="detail-value">{{ $student->phone }}</div>
                    </div>
                    <div class="detail-item">
                        <label>Address</label>
                        <div class="detail-value">{{ $student->address ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="action-buttons">
                     <a href="{{ route('students.edit', $student->id) }}">
                        <button class="btn btn-info">
                            Edit Student
                        </button>
                    </a>
                    <a href="{{ route('students.index', $student->id) }}">
                        <button class="btn btn-primary ">
                            Back to list 
                        </button>
                     </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection