<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Pacient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    public function index(){
        $appointments = DB::table('appointments')
        ->select('pacients.first_name','pacients.last_name','pacients.phone','title','start_time','date_start','price')
        ->join('pacients', 'pacients.id', '=', 'appointments.pacient_id')
        ->get();
        $pacients = Pacient::select('id','first_name','last_name')->get();
        return Inertia::render('Dashboard/Appointments/Index',['appointments' => $appointments,'pacients' => $pacients]);
    }
    public function store(StoreAppointmentRequest $request){
        Appointment::create($request->validated());
        return redirect()->route('appointments.index');
    }
}
