<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            $file->move(public_path('/upload'), date('Ymd_His') . '_' . $file->getClientOriginalName());

            return redirect()->back()->with(['success' => 'Upload ok']);

        } else {
            return redirect()->back()->with(['errors' => $validator->errors()->all()]);
        }
    }
}
