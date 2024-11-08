<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class EmployeeAPIController
 */
class EmployeeAPIController extends AppBaseController
{
    private EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepo)
    {
        $this->employeeRepository = $employeeRepo;
    }

    /**
     * Display a listing of the Employees.
     * GET|HEAD /employees
     */
    public function index(Request $request): JsonResponse
    {
        if($request->has('search')) {
            $employees = Employee::search($request->search)->paginate(10);
            return $this->sendResponse($employees, 'Employees retrieved successfully');
        }
        $employees = $this->employeeRepository->paginate(10);

        return $this->sendResponse($employees, 'Employees retrieved successfully');
    }

    /**
     * Store a newly created Employee in storage.
     * POST /employees
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $employee = $this->employeeRepository->create($input);

        return $this->sendResponse($employee->toArray(), 'Employee saved successfully');
    }

    /**
     * Display the specified Employee.
     * GET|HEAD /employees/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Employee $employee */
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            return $this->sendError('Employee not found');
        }

        return $this->sendResponse($employee->toArray(), 'Employee retrieved successfully');
    }

    /**
     * Update the specified Employee in storage.
     * PUT/PATCH /employees/{id}
     */
    public function update($id, Request $request): JsonResponse
    {
        $input = $request->all();

        /** @var Employee $employee */
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            return $this->sendError('Employee not found');
        }

        $employee = $this->employeeRepository->update($input, $id);

        return $this->sendResponse($employee->toArray(), 'Employee updated successfully');
    }

    /**
     * Remove the specified Employee from storage.
     * DELETE /employees/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Employee $employee */
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            return $this->sendError('Employee not found');
        }

        $employee->delete();

        return $this->sendSuccess('Employee deleted successfully');
    }
}
