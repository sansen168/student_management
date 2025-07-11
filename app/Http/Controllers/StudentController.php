<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class StudentController extends Controller
{
    public function index()
    {
        $students = Student::paginate(2); // Changed from 2 to a more common value
        return view('pages.index', compact('students'));
    }
    public function store(Request $request)
    {
        // Consistent validation rules with the update method
        $validatedData = $request->validate([
            'stu_name' => 'required|string|max:255',
            'gender' => 'required|in:M,F',
            'age' => 'required|integer|min:1',
            'major' => 'required|string',
            'major_price' => 'required|numeric',
            'enrollment_date' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload if a file is present
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $imagePath = $request->file('image')->storeAs('students_images', $filename, 'public');
            $validatedData['image'] = $imagePath;
        }
        // dd($validatedData);
        Student::create($validatedData);
        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }
    public function show(Student $student)
    {
        // Using route-model binding for cleaner code
        return view('pages.show', compact('student'));
    }
    public function edit(Student $student)
    {
        // Using route-model binding
        return view('pages.edit', compact('student'));
    }
    public function update(Request $request, Student $student)
    {
        // 1. VALIDATE THE INCOMING DATA
        $validatedData = $request->validate([
            'stu_name' => 'required|string|max:255',
            'gender' => 'required|in:M,F',
            'age' => 'required|integer|min:1',
            'major' => 'required|string',
            'major_price' => 'required|numeric',
            'enrollment_date' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            // Image is 'nullable', meaning it's optional on update.
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
        // 2. HANDLE THE IMAGE FILE UPLOAD (IF A NEW ONE IS PROVIDED)
        if ($request->hasFile('image')) {
            // Delete the old image from storage if it exists
            if ($student->image) {
                Storage::disk('public')->delete($student->image);
            }
            // Store the new image and get its path
            $filename = time() . '.' . $request->image->extension();
            $imagePath = $request->file('image')->storeAs('students_images', $filename, 'public');
            // Add the new image path to our data array so it gets saved to the database
            $validatedData['image'] = $imagePath;
        }
        // 3. UPDATE THE STUDENT RECORD IN THE DATABASE
        // Laravel's Route-Model binding has already fetched the $student object for us.
        $student->update($validatedData);
        // 4. REDIRECT WITH A SUCCESS MESSAGE
        return redirect()->route('students.index')->with('success', 'Student information updated successfully!');
    }
    public function destroy(Student $student)
    {
        // dd($student);
        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
