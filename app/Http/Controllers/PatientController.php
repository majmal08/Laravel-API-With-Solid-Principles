<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PatientRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use App\Jobs\TestSendEmail;
use App\Models\Patient;


class PatientController extends BaseController
{

    public function fileImport(Request $request)
    {

       $data = Excel::toArray( new UsersImport, $request->file( 'file' ))[0];

       $userJob = new TestSendEmail($data);       
       $this->dispatch($userJob);
       return redirect()->route('import.done');
           
    }

    public function impoertDone(){
        return view('importDone');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->successResponse(true, Patient::all(), 'all patients', 200);
        } catch (\Exception $e) {
            return $this->errorResponse(false, 'something went wrong', 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {        
        try {
            $request->validated();
            Patient::create($request->all());
            return $this->successResponse(true, [], 'patient store successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse(false, 'something went wrong', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        try {
            return $this->successResponse(true, $patient, 'patient data', 200);
        } catch (\Exception $e) {
            return $this->errorResponse(false, 'something went wrong', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, Patient $patient)
    {
        try {
            $request->validated();
            $patient->update($request->all());
            return $this->successResponse(true, [], 'patient updated successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse(false, 'something went wrong', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        try {
            $patient->delete();
            return $this->successResponse(true, [], 'patient deleted successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse(false, 'something went wrong', 500);
        }
    }

}
