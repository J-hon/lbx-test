<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadCsvRequest;
use App\Jobs\ExportCsvToDatabaseJob;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{

    public function index(): JsonResponse
    {
        $employees = Employee::paginate(request('limit', 10));
        return $this->responseJson(message: 'Employees retrieved successfully', data: $employees);
    }

    public function show(int $id): JsonResponse
    {
        $employee = $this->find($id);
        return $this->responseJson(message: 'Employee retrieved successfully', data: $employee);
    }

    public function upload(UploadCsvRequest $request): JsonResponse
    {
        $file     = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $file->storeAs('uploads', $fileName, 'public');

        ExportCsvToDatabaseJob::dispatch($fileName);

        return $this->responseJson(message: 'File uploaded successfully');
    }

    public function destroy(int $id): JsonResponse
    {
        $this->find($id)->delete();
        return $this->responseJson(message: 'Employee deleted successfully');
    }

    private function find(int $id): Employee
    {
        return Employee::find($id);
    }

}
