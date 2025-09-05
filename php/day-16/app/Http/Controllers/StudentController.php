<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use Storage;

class StudentController extends Controller {
  /**
   * Display a listing of the resource.
   */
  public function index() {
    return view('students.index', ['students' => Student::all()]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create() {
    return view('students.create', ['departments' => Department::all()]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreStudentRequest $request) {
    $validated = $request->validated();

    if ($request->hasFile('image')) {
      // Store in storage/app/public/students
      $validated['image'] = $request->file('image')->store('students', 'public');
    }

    Student::create($validated);

    return redirect()
      ->route('students.index')
      ->with('success', 'Student created successfully.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Student $student) {
    return view('students.show', compact('student'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Student $student) {
    $departments = Department::all();
    return view('students.edit', compact('student', 'departments'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateStudentRequest $request, Student $student) {
    $validated = $request->validated();

    if ($request->hasFile('image')) {
      // Delete old file if exists
      if ($student->image && Storage::disk('public')->exists($student->image)) {
        Storage::disk('public')->delete($student->image);
      }

      $validated['image'] = $request->file('image')->store('students', 'public');
    }

    $student->update($validated);

    return redirect()
      ->route('students.index')
      ->with('success', 'Student updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Student $student) {
    Student::destroy($student->id);
    return to_route('students.index')->with('success', 'Student deleted successfully.');
  }
}
