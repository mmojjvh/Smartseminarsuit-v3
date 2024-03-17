<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Domain\Interfaces\Repositories\Backoffice\IFAQsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IRecordsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IPatientsRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IServicesRepository;
use App\Domain\Interfaces\Repositories\Backoffice\IAppointmentsRepository;

use Input;

class DashboardController extends Controller
{
    public function __construct(
                                IFAQsRepository $faqRepo,
                                IRecordsRepository $recordRepo, 
                                IPatientsRepository $patientRepo, 
                                IServicesRepository $serviceRepo, 
                                IAppointmentsRepository $appointmentRepo){
        $this->data = [];
        $this->faqRepo = $faqRepo;
        $this->recordRepo = $recordRepo;
        $this->patientRepo = $patientRepo;
        $this->serviceRepo = $serviceRepo;
        $this->appointmentRepo = $appointmentRepo;
    }
    
    public function index(){
        $this->data['faqs'] = $this->faqRepo->fetch();
        $this->data['patientCount'] = $this->patientRepo->fetch()->count();
        $this->data['newPatientCount'] = $this->patientRepo->newPatients()->count();
        $this->data['appointmentsCount'] = $this->appointmentRepo->scheduledAppoints()->count();
        $this->data['appointments'] = $this->appointmentRepo->fetch();
    	return view('backoffice.pages.dashboard.index', $this->data);
    }

    public function downloadReport($start, $end){
        $availedServices = $this->recordRepo->getAvailedServices($start, $end);
        $fileName = 'EarningSummaryReport-'.$start.'-'.$end.'.csv';
        $services = $availedServices;

        $headers = array(
            "Content-type"        => "application/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Date', 'Patient Name', 'Services', 'Price');

        $callback = function() use($services, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            $totalPayments = 0;

            foreach ($services as $service) {
                $row['Date']         = $service->date;
                $row['Patient Name'] = $service->record->patient->user->name;
                $row['Services']     = $service->service->name;
                $row['Price']        = $service->payment;
                $totalPayments+=$service->payment;

                fputcsv($file, array($row['Date'], $row['Patient Name'], $row['Services'], $row['Price']));
            }

            fputcsv($file, array('Total Payment', '', '', $totalPayments));

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    
    public function viewReport(){
        $start = Input::get('_start');
        $end = Input::get('_end');
        $availedServices = $this->recordRepo->getAvailedServices($start, $end);
        $totalPayments = 0;
        $services = [];
        foreach ($availedServices as $service) {
            $totalPayments += $service->payment;
            array_push($services,[  
                'date'         => $service->date,
                'patient_name' => $service->record->patient->user->name,
                'service'      => $service->service->name,
                'price'        => $service->payment,
            ]);
        }
        $data['datas'] = ['services' => $services, 'total_payments' => $totalPayments];
        return response()->json($data, 200); 
    }

    public function viewAppointment(){
        $start = Input::get('_start');
        $end = Input::get('_end');
        $appointments = $this->appointmentRepo->getAppointments($start, $end);
        $appts = [];
        foreach ($appointments as $appointment) {
            array_push($appts,[  
                'start'        => $appointment->start,
                'end'          => $appointment->end,
                'patient_name' => $appointment->patient->user->name,
                'service'      => $appointment->service->name,
                'status'       => $appointment->status,
            ]);
        }
        $data['datas'] = ['appointments' => $appts];
        return response()->json($data, 200); 
    }

    public function downloadAppointments($start, $end){
        $appointments = $this->appointmentRepo->getAppointments($start, $end);
        $fileName = 'AppointmentSummaryReport-'.$start.'-'.$end.'.csv';

        $headers = array(
            "Content-type"        => "application/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Patient Name', 'Service', 'Start', 'End', 'Status');

        $callback = function() use($appointments, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($appointments as $appointment) {
                
                $row['Patient Name'] = $appointment->patient->user->name;
                $row['Service']      = $appointment->service->name;
                $row['Start']        = $appointment->start;
                $row['End']          = $appointment->end;
                $row['Status']       = $appointment->status;

                fputcsv($file, array($row['Patient Name'], $row['Service'], $row['Start'], $row['End'], $row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
