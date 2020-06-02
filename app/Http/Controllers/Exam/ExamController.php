<?php

namespace App\Http\Controllers\Exam;

use App\Domain\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Importer;

class ExamController extends Controller
{
    /**
     * Display form to upload Excel sheet.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploadExamForm()
    {
        return view('exam/uploadExamForm');
    }


    /**
     * Upload Excel sheet.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadExam(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:5000|mimes:xlsx,xls'
        ]);
        if ($validator->passes()) {

            $file = $request->file('file');
            $savePath = public_path('/upload/');
            $fileName = date('Ymd_His') . '_' . $file->getClientOriginalName();
            $file->move($savePath, $fileName);

            $results = (new Exam($savePath . $fileName))->getResults();

            return redirect()->back()->with([
                'studentResults' => $results['studentResults']
            ]);

        } else {
            return redirect()->back()->with(['errors' => $validator->errors()->all()]);
        }
    }
}
