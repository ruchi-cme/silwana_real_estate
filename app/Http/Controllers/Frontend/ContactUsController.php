<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BrokerContactUs;
use Illuminate\Http\Request;
use DB;
class ContactUsController extends Controller
{
    public function index() {
        // echo "1";die;
        $contactUs   = getContactUsDetail();
        $page        = getSilwanaPages('contactus_intrest');
        return view('front.contactUs',compact('contactUs','page'));
    }

    public function brokercontatctUs(Request $req){
        $data['js'] = 'agentform';
        if($req->all()){
            // dd($req->all());
            $willInsertArray = [
                'agency_company_name'=>$req->agency_company_name,
                'agency_company_address'=>$req->agency_company_address,
                'company_phone'=>$req->company_phone,
                'company_mobile'=>$req->company_mobile,
                'company_email'=>$req->company_email,
                'zip_code'=>$req->zip_code,
                'po_box'=>$req->po_box,
                'trade_licence'=>$req->trade_licence,
                'trade_licence_validity'=>$req->trade_licence_validity,
                'rera'=>$req->rera,
                'rera_validity'=>$req->rera_validity,
                'tax_reg'=>$req->tax_reg,
                'trn_validity'=>$req->trn_validity,
                'beneficiary_name'=>$req->beneficiary_name,
                'account'=>$req->account,
                'iban'=>$req->iban,
                'swift_code'=>$req->swift_code,
                'bank_name'=>$req->bank_name,
                'bank_address'=>$req->bank_address,
                'account_currency'=>$req->account_currency,
                'name_of_authorized_signatory_on_passport'=>$req->name_of_authorized_signatory_on_passport,
                'personal_email'=>$req->personal_email,
                'address'=>$req->address,
                'mobile'=>$req->mobile,
                'passport_number'=>$req->passport_number,
                'passport_validity'=>$req->passport_validity,
                'nationality'=>$req->nationality,
                'designation'=>$req->designation,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ];
            // dd($willInsertArray);
            $status = DB::table('broker_contact_us')->insert($willInsertArray);
            if($status){
                return redirect('/brokercontatctUs')->with('Mymessage', flashMessage('success','Form Submited Successfully'));
            }else{
                return redirect('/brokercontatctUs')->with('Mymessage', flashMessage('danger','Somthing Went Wrong'));
            }
        }
        return view('front.brokerContactUs',$data);
    }
}

