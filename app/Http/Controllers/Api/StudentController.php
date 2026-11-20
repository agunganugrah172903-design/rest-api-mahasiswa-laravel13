<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    public function index(): JsonResponse
    {
        $students = Student::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Daftar data mahasiswa berhasil diambil.',
            'data'    => StudentResource::collection($students),
            'meta'    => [
                'current_page' => $students->currentPage(),
                'per_page'     => $students->perPage(),
                'total'        => $students->total(),
                'last_page'    => $students->lastPage(),
            ],
        ], 200);
    }

    public function store(StoreStudentRequest $request): JsonResponse
    {
        $student = Student::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil ditambahkan.',
            'data'    => new StudentResource($student),
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => "Data mahasiswa dengan ID $id tidak ditemukan.",
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data mahasiswa berhasil ditemukan.',
            'data'    => new StudentResource($student),
        ], 200);
    }

    public function update(UpdateStudentRequest $request, string $id): JsonResponse
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => "Data mahasiswa dengan ID $id tidak ditemukan.",
                'data'    => null,
            ], 404);
        }

        $student->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil diperbarui.',
            'data'    => new StudentResource($student->fresh()),
        ], 200);
    }

    public function destroy(string $id): JsonResponse
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => "Data mahasiswa dengan ID $id tidak ditemukan.",
                'data'    => null,
            ], 404);
        }

        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil dihapus.',
            'data'    => null,
        ], 200);
    }
}