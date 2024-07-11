<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Fpdi;
use App\Mail\AgentPDFMail;
use App\Mail\PdfMergedMail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\PdfParser\StreamReader;
use Intervention\Image\Laravel\Facades\Image;

class PdfMergeController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->file('student_signature'));
        // agent stamp image
        $agent_stamp_image = $request->file('agent_stamp_file');
        $imagePath = $agent_stamp_image->store('public/images');
        $imageUrl = storage_path('app/' . $imagePath);

        // staff signature
        $signature_attach = $request->file('student_signature');
        $signature_attach_path = $signature_attach->store('public/images');
        $signature_attach_url = storage_path('app/' . $signature_attach_path);

        $usi_staff_signature_attach = $request->file('usi_staff_signature_attach');
        $usi_staff_signature_attach_path = $usi_staff_signature_attach->store('public/images');
        $usi_staff_signature_attach_url = storage_path('app/' . $usi_staff_signature_attach_path);

        $pdf = new Fpdi();
        // dd($signature_attach_url);
        $data = [
            "course" => $request->course,
            "airport_pickup" => $request->airport_pickup,
            "title" => $request->title,
            "gender" => $request->gender,
            "family_name" => $request->family_name,
            "given_name" => $request->given_name,
            "place_birth" => $request->place_birth,
            "date_of_birth" => $request->date_of_birth,
            "nationality" => $request->nationality,
            "passport" => $request->passport,
            "passport_expiry" => $request->passport_expiry,
            "visa_type" => $request->visa_type,
            "visa_subclass" => $request->visa_subclass,
            "visa_number" => $request->visa_number,
            "visa_expiry" => $request->visa_expiry,
            "oshc_cover" => $request->oshc_cover,
            "oshc_cover_provider" => $request->oshc_cover_provider ? $request->oshc_cover_provider : "",
            "oshc_cover_provider_if_no" => $request->oshc_cover_provider_if_no ? $request->oshc_cover_provider_if_no : "",
            "oshc_cover_family_member_name" => $request->oshc_cover_family_member_name,
            "oshc_cover_date_birth" => $request->oshc_cover_date_birth,
            "overseas_gender" => $request->overseas_gender,
            "oshc_cover_study_australia" => $request->oshc_cover_study_australia,
            "oshc_cover_name_institute" => $request->oshc_cover_name_institute,
            "oshc_cover_transferring_education" => $request->oshc_cover_transferring_education,
            "usi_cover" => $request->usi_cover,
            "usi_specify" => $request->usi_specify,
            "usi_staff_name" => $request->usi_staff_name,
            "usi_staff_date" => $request->usi_staff_date,
            "contact_home_address" => $request->contact_home_address,
            "contact_home_country" => $request->contact_home_country,
            "contact_home_phone" => $request->contact_home_phone,
            "contact_home_email" => $request->contact_home_email,
            "contact_australia_building" => $request->contact_australia_building,
            "contact_australia_flat" => $request->contact_australia_flat,
            "contact_australia_street_no" => $request->contact_australia_street_no,
            "contact_australia_street_name" => $request->contact_australia_street_name,
            "contact_australia_suburb" => $request->contact_australia_suburb,
            "contact_australia_state" => $request->contact_australia_state,
            "contact_australia_postcode" => $request->contact_australia_postcode,
            "contact_australia_mobile" => $request->contact_australia_mobile,
            "contact_australia_email" => $request->contact_australia_email,
            "postal_address_building" => $request->postal_address_building,
            "postal_address_flat" => $request->postal_address_flat,
            "postal_address_street_no" => $request->postal_address_street_no,
            "postal_address_street_name" => $request->postal_address_street_name,
            "postal_address_suburb" => $request->postal_address_suburb,
            "postal_address_state" => $request->postal_address_state,
            "postal_address_postcode" => $request->postal_address_postcode,
            "postal_address_delivery_box" => $request->postal_address_delivery_box,
            "preferred_contact_method" => $request->preferred_contact_method,
            "emergency_contact_name" => $request->emergency_contact_name,
            "emergency_contact_phone" => $request->emergency_contact_phone,
            "emergency_contact_relationship" => $request->emergency_contact_relationship,
            "english_is_required" => $request->english_is_required,
            "assessment_type" => $request->assessment_type,
            "english_score_achieved" => $request->english_score_achieved,
            "english_score_date" => $request->english_score_date,
            "previous_qualification_yes_or_no" => $request->previous_qualification_yes_or_no,

            "prev_qual_bachelors" => $request->prev_qual_bachelors ? $request->prev_qual_bachelors : "",
            "prev_qual_degree" => $request->prev_qual_degree ? $request->prev_qual_degree : "",
            "prev_qual_advanceOrdiploma" => $request->prev_qual_advanceOrdiploma ? $request->prev_qual_advanceOrdiploma : "",
            "prev_qual_diploma" => $request->prev_qual_diploma ? $request->prev_qual_diploma : "",
            "prev_qual_year_twelve" => $request->prev_qual_year_twelve ? $request->prev_qual_year_twelve : "",
            "prev_qual_certification_four" => $request->prev_qual_certification_four ?: "",
            "prev_qual_certification_three" => $request->prev_qual_certification_three ? $request->prev_qual_certification_three : "",
            "prev_qual_certification_two" => $request->prev_qual_certification_two ? $request->prev_qual_certification_two : "",

            "prev_qual_list" => $request->prev_qual_list,
            "assessedOrNot" => $request->assessedOrNot ? $request->assessedOrNot : "",
            "most_recent_qualification" => $request->most_recent_qualification,
            "most_recent_school" => $request->most_recent_school,
            "most_recent_country" => $request->most_recent_country,
            "most_recent_year_complete" => $request->most_recent_year_complete,
            "rpl_transfer" => $request->rpl_transfer,
            "reasonsOfTakingCourse_get_a_job" => $request->reasonsOfTakingCourse_get_a_job,
            "reasonsOfTakingCourse_better_promotion" => $request->reasonsOfTakingCourse_better_promotion,
            "reasonsOfTakingCourse_getreasonsOfTakingCourse_part_time_job_a_job" => $request->reasonsOfTakingCourse_part_time_job,
            "reasonsOfTakingCourse_career_in_new_field" => $request->reasonsOfTakingCourse_career_in_new_field,
            "reasonsOfTakingCourse_start_a_business" => $request->reasonsOfTakingCourse_start_a_business,
            "reasonsOfTakingCourse_gain_new_skill" => $request->reasonsOfTakingCourse_gain_new_skill,
            "reasonsOfTakingCourse_gain_knowledge" => $request->reasonsOfTakingCourse_gain_knowledge,
            "reasonsOfTakingCourse_personal_interest" => $request->reasonsOfTakingCourse_personal_interest,
            "other_reason_to_study" => $request->other_reason_to_study ? $request->other_reason_to_study : "",
            "special_support" => $request->special_support,
            "disability" => $request->disability,
            "other_special" => $request->other_special,
            "employment" => $request->employment,
            "student_name" => $request->student_name,
            "student_date" => $request->student_date,

            "completed_all_sections" => $request->completed_all_sections,
            "relevant_employment_documentation" => $request->relevant_employment_documentation,
            "copies_of_visa" => $request->copies_of_visa,
            "other_relevant_documentation" => $request->other_relevant_documentation,
            "copies_of_passport" => $request->copies_of_passport,
            "signed_the_declaration" => $request->signed_the_declaration,
            "copies_of_qualification" => $request->copies_of_qualification,
            "copies_of_english_proficiency" => $request->copies_of_english_proficiency,
            "copies_current_ohsc" => $request->copies_current_ohsc,

            "education_agency_name" => $request->education_agency_name,
            "education_agent_name" => $request->education_agent_name,
            "education_agent_mail" => $request->education_agent_mail,
            "comply_one" => $request->comply_one,
            "comply_two" => $request->comply_two,
            "comply_three" => $request->comply_three,
            "comply_four" => $request->comply_four,
            "comply_five" => $request->comply_five,
            "comply_six" => $request->comply_six,
            "comply_seven" => $request->comply_seven,
            "agent_stamp_file" => $imageUrl,
            "student_important_files" => $request->student_important_files,
            "signature_attach" => $signature_attach_url,
            "usi_staff_signature_attach_url" => $usi_staff_signature_attach_url,
            "student_signature" => $request->student_signature,
            "query_files" => $request->query_files,
        ];
        $html = View::make('mail', $data)->render();
        // Convert HTML to PDF using dompdf

        // dd($html);
        $domPdf = Pdf::loadHTML($html);
        $domPdf->setPaper('A4', 'portrait');
        $tempPdfPath = public_path('assets/files/temp_output.pdf');
        $domPdf->save($tempPdfPath);
        // dd(file($tempPdfPath));
        // $fileArray = $request->files;
        $pageCount = $pdf->setSourceFile($tempPdfPath);

        for ($i = 0; $i < $pageCount; $i++) {
            $pdf->AddPage();
            $tplId = $pdf->importPage($i + 1);
            $pdf->useTemplate($tplId);
        }
        $fileArray = [];
        array_push($fileArray, $request->file('agent_stamp_file'));
        if ($request->file('student_important_files') != "") {
            array_push($fileArray, $request->file('student_important_files'));
        }

        array_push($fileArray, $request->file('usi_staff_signature_attach'));
        array_push($fileArray, $request->file('student_signature'));
        array_push($fileArray, $request->file('query_files'));
        $fileToDeleteArray = [];
        foreach ($fileArray as $file) {
            // dd($file);
            // $file_attach = $file;
            // $fileName = $file->getClientOriginalName();
            // $fileExtension = $file->getClientOriginalExtension();
            // $filePath = $file->move(public_path('assets/files'), $fileName);
            // $fileFullPath = $filePath->getPathname();
            
            $fileExtension = $file->getClientOriginalExtension();
            $file_attach_path = $file->store('public/images');
            $file_attach_url = storage_path('app/' . $file_attach_path);
            array_push($fileToDeleteArray,$file_attach_path);
            // if (!file_exists($fileFullPath)) {
            //     return response()->json(['error' => 'File not found: ' . $fileFullPath], 404);
            // }
            // set the source file and get the number of pages in the document
            try {
                // Initialize FPDI and add pages from the temporary PDF

                if ($fileExtension === 'pdf') {
                    // Handle PDF files
                    $stream = StreamReader::createByFile($file_attach_url);
                    $pageCount = $pdf->setSourceFile($stream);

                    for ($i = 0; $i < $pageCount; $i++) {
                        $pdf->AddPage();
                        $tplId = $pdf->importPage($i + 1);
                        $pdf->useTemplate($tplId);
                    }
                } elseif (in_array($fileExtension, ['jpeg', 'jpg', 'png'])) {
                    // Handle JPEG and PNG files
                    $image = Image::read($file_attach_url);
                    $image->resize($pdf->GetPageWidth(), $pdf->GetPageHeight(), function ($constraint) {
                        $constraint->aspectRatio(); // Maintain aspect ratio
                        $constraint->upsize(); // Prevent upsizing
                    });
                    $pdf->AddPage();
                    $pdf->Image($file_attach_url, 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
                } else {
                    return response()->json(['error' => 'Unsupported file type: ' . $fileExtension], 400);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Error processing file: ' . $fileExtension . ' - ' .
                        $e->getMessage()
                ], 500);
            }
        }
        // dd($fileToDeleteArray);
        foreach($fileToDeleteArray as $file){
            unlink(storage_path('app/' . $file));
        }
        // }
        $pdfContent = $pdf->Output('', 'S');
        //return the generated PDF
        // unlink(storage_path('app/' . $imagePath));
        // unlink(storage_path('app/' . $signature_attach_path));
        // unlink(storage_path('app/' . $usi_staff_signature_attach_path));

        try {
            Mail::to('megatanjib@gmail.com')->send(new PdfMergedMail($pdfContent));
            // Optionally, you can delete the generated PDF file here if needed
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
        }
    }

    public function agent_form(Request $request)
    {
        $signature_attach = $request->file('signature');
        $signature_attach_path = $signature_attach->store('public/agent-signature');
        $signature_attach_url = storage_path('app/' . $signature_attach_path);
        // dd($request->all());
        $pdf = new Fpdi();

        $data = [
            "copy_of_business_registration" => $request->copy_of_business_registration,
            "evidence_of_EATC" => $request->evidence_of_EATC,
            "company_legal_name" => $request->company_legal_name,
            "date_of_company_registration" => $request->date_of_company_registration,
            "trading_as" => $request->trading_as,
            "business_address" => $request->business_address,
            "abn" => $request->abn,
            "year_of_registration" => $request->year_of_registration,
            "owners_name" => $request->owners_name,
            "owners_contact_details" => $request->owners_contact_details,
            "manager_name" => $request->manager_name,
            "manager_contact_details" => $request->manager_contact_details,
            "agent_phone" => $request->agent_phone,
            "agent_mobile_no" => $request->agent_mobile_no,
            "agent_website" => $request->agent_website,
            "number_of_staffs" => $request->number_of_staffs,
            "num_students_australian_institutions" => $request->num_students_australian_institutions,
            "elicos_st" => $request->elicos_st,
            "tafe_st" => $request->tafe_st,
            "undergraduate_st" => $request->undergraduate_st,
            "postgraduate_st" => $request->postgraduate_st,
            "represent_australia" => $request->represent_australia,
            "activities" => $request->activities,
            "education_agent_yes_or_no" => $request->education_agent_yes_or_no,
            "if_yes_provide_details" => $request->if_yes_provide_details,
            "suitable_time_student" => $request->suitable_time_student,
            "assist" => $request->assist,
            "assist_students_through" => $request->assist_students_through,
            "referee_company_name" => $request->referee_company_name,
            "referee_contact_person" => $request->referee_contact_person,
            "referee_phone" => $request->referee_phone,
            "referee_position" => $request->referee_position,
            "referee_address" => $request->referee_address,
            "referee_email" => $request->referee_email,
            "referee_two_company_name" => $request->referee_two_company_name,
            "referee_two_contact_person" => $request->referee_two_contact_person,
            "referee_two_phone" => $request->referee_two_phone,
            "referee_two_position" => $request->referee_two_position,
            "referee_two_address" => $request->referee_two_address,
            "referee_two_email" => $request->referee_two_email,
            "financial_institution_name" => $request->financial_institution_name,
            "agent_bank_address" => $request->agent_bank_address,
            "agent_bank_account_name" => $request->agent_bank_account_name,
            "swift_code" => $request->swift_code,
            "bsb_code" => $request->bsb_code,
            "account_number_agent" => $request->account_number_agent,
            "name_of_the_officer" => $request->name_of_the_officer,
            "financial_institution_name_two" => $request->financial_institution_name_two,
            "agent_bank_address" => $request->agent_bank_address,
            "agent_bank_account_name" => $request->agent_bank_account_name,
            "signature" => $signature_attach_url,
            "declaration_date" => $request->declaration_date,
        ];

        $html = View::make('agentMail', $data)->render();
        // Convert HTML to PDF using dompdf
        $domPdf = Pdf::loadHTML($html);
        $domPdf->setPaper('A4', 'portrait');
        $tempPdfPath = public_path('assets/files/temp_output.pdf');
        $domPdf->save($tempPdfPath);
        $pageCount = $pdf->setSourceFile($tempPdfPath);

        for ($i = 0; $i < $pageCount; $i++) {
            $pdf->AddPage();
            $tplId = $pdf->importPage($i + 1);
            $pdf->useTemplate($tplId);
        }

        $fileName = $signature_attach->getClientOriginalName();
        $fileExtension = $signature_attach->getClientOriginalExtension();
        $filePath = $signature_attach->move(public_path('assets/agent_files'), $fileName);
        $fileFullPath = $filePath->getPathname();

        if (!file_exists($fileFullPath)) {
            return response()->json(['error' => 'File not found: ' . $fileFullPath], 404);
        }

        try {
            // Render the Blade template to HTML


            // Initialize FPDI and add pages from the temporary PDF

            if ($fileExtension === 'pdf') {
                // Handle PDF files
                $stream = StreamReader::createByFile($fileFullPath);
                $pageCount = $pdf->setSourceFile($stream);

                for ($i = 0; $i < $pageCount; $i++) {
                    $pdf->AddPage();
                    $tplId = $pdf->importPage($i + 1);
                    $pdf->useTemplate($tplId);
                }
            } elseif (in_array($fileExtension, ['jpeg', 'jpg', 'png'])) {
                // Handle JPEG and PNG files
                $image = Image::read($fileFullPath);
                $image->resize($pdf->GetPageWidth(), $pdf->GetPageHeight(), function ($constraint) {
                    $constraint->aspectRatio(); // Maintain aspect ratio
                    $constraint->upsize(); // Prevent upsizing
                });
                $pdf->AddPage();
                $pdf->Image($fileFullPath, 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
            } else {
                return response()->json(['error' => 'Unsupported file type: ' . $fileExtension], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error processing file: ' . $fileExtension . ' - ' .
                    $e->getMessage()
            ], 500);
        }
        $pdfContent = $pdf->Output('', 'S');
        //return the generated PDF
        unlink(storage_path('app/' . $signature_attach_path));

        try {
            Mail::to('megatanjib@gmail.com')->send(new AgentPDFMail($pdfContent));
            // Optionally, you can delete the generated PDF file here if needed
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
        }
    }
}
