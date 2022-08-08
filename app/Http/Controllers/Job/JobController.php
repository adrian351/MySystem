<?php
namespace App\Http\Controllers\Job;
use App\Http\Controllers\Controller;
//Models
use App\Models\Jobs;
use App\Models\FailedJobs;
// Request
use Illuminate\Http\Request;

class JobController extends Controller {
  public function indexJob(Request $request) {
    $jobs = Jobs::buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    return view('job.job.job_index', compact('jobs'));
  }
  public function indexFailedJob(Request $request) {
    $failed_jobs = FailedJobs::buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
    return view('job.failed.jfai_index', compact('failed_jobs'));
  }
}
