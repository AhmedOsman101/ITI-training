<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller {
  /**
   * Display a listing of the resource.
   */
  public function index() {
    return view('departments.index', ['departments' => Department::all()]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create() {
    return view('departments.create', ['departments' => Department::all()]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) {
    Department::create(
      $request->validate([
        'name' => ['required', 'unique:departments,name'],
      ])
    );

    return redirect()
      ->route('departments.index')
      ->with('success', 'Department created successfully.');

  }

  /**
   * Display the specified resource.
   */
  public function show(Department $department) {
    return view('departments.show', compact('department'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Department $department) {
    return view('departments.edit', compact('department'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Department $department) {
    $department->update(
      $request->validate([
        'name' => [
          'required',
          Rule::unique('departments', 'name')->ignore($department->id),
        ],
      ])
    );

    return redirect()
      ->route('departments.index')
      ->with('success', 'Department updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Department $department) {
    $department->delete();

    return redirect()
      ->route('departments.index')
      ->with('success', 'Department deleted successfully.');
  }
}
