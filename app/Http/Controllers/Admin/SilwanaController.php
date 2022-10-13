<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Silwana,SilwanaDetailMapping};
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Config;

class SilwanaController extends Controller
{

    /**
     * Responds with a data message with instructions
     *
     * @return array
     */

    public function index(Request $request)
    {
        if($request->ajax())
        {
            /* Current Login User ID */
            $userID = auth()->user()->id;

            $pageDetails = Silwana::select([ 'silwana_detail_id','page','detail','status'])
                            ->where('deleted',0)
                            ->orderByDesc("silwana_detail_id")
                            ->get();
            $data = $pageDetails->map(function ($data){

                return [
                    'id'            => $data->silwana_detail_id,
                    'page'          => $data->page,
                    'detail'          => $data->detail,
                    'status'        => !empty($data->status) && ($data->status == 1) ? 'Active' : 'Inctive',
                    'created_date'  => $data->created_date ,
                ];
            });
            return DataTables::of($data)->toJson();
        }
        return view('admin.aboutSilwana.index');
    }

    /**
     * Add Edit page
     *
     * @return array
     */
    public function create(Request $request)
    {
        $pageId = Config::get('constants.page_id');
        $pageData = Silwana::find($request->id);
        $pageDetail  = SilwanaDetailMapping::where('silwana_detail_id' , $request->id)->get()->toArray();
      /* $select =  [ 'silwana_detail_master.silwana_detail_id',
                    'silwana_detail_master.page',
                    'silwana_detail_master.detail',
                    'silwana_detail_master.page_image',
                    'silwana_details_mapping.silwana_dtl_mpg_id',
                    'silwana_details_mapping.icon',
                    'silwana_details_mapping.heading',
                    'silwana_details_mapping.heading_detail',
                    'silwana_details_mapping.heading_image'];
        $pageData = Silwana::leftJoin('silwana_details_mapping', 'silwana_details_mapping.silwana_detail_id', '=', 'silwana_detail_master.silwana_detail_id')
                    ->select($select)
                    ->where('silwana_detail_master.silwana_detail_id', $request->id)
                    ->first();*/

        return view('admin.aboutSilwana.create' ,compact('pageData','pageDetail','pageId'));
    }

    /**
     * Save Data
     *
     * @return array
     */
    public function store(Request $request)
    {
        $request->validate([
            'page'   => 'required',
            'detail' => 'required',

        ]);
        /* Insert Page data */
        $userID   = auth()->user()->id;
        $pageImage = null;

        if ($image = $request->file('page_image')) {
            $destinationPath = public_path('images/page');
            $pageImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $pageImage);
        }
        $page  = [
            'page'       => $request->page,
            'detail'     => $request->detail,
            'page_id'    => $request->page_id,
            'page_image' => $pageImage,
            'status'     => 1,
            'created_by' => $userID
        ];
        $silwana_id =  Silwana::create($page);


        /* Insert Page Details data*/
        $subHeadingImage = null;



        for ($i = 0; $i < count($request->heading); $i++) {

            $headingImage = $request->file('heading_image') ;
            if (isset($headingImage)) {
                $headingImage = $request->file('heading_image')[$i];
                $destinationPath = public_path('images/heading');
                $subHeadingImage = date('YmdHis') . "." . $headingImage->getClientOriginalName();
                $headingImage->move($destinationPath, $subHeadingImage);
            }
            $pageDetail[]  = [
                'silwana_detail_id' => $silwana_id['silwana_detail_id'] ,
                'created_by'         =>$userID,
                'icon'              => $request->icon[$i]  ,
                'heading'           => $request->heading[$i]  ,
                'heading_detail'    => $request->heading_detail[$i]   ,
                'heading_image'     => $subHeadingImage ,
                'status'            => 1,
            ];
        }

        SilwanaDetailMapping::insert($pageDetail);

        return redirect()->route('admin.silwana')->with('inserted','Page Created👍');
    }

    /**
     * Update Data
     *
     * @return array
     */
    public function update(Request $request)
    {

        $silwana  = Silwana::find( $request->silwana_detail_id);
        $userID   = auth()->user()->id;
        /* Insert Page data */

        $image = $request->file('page_image');
        $editPageImage = $request->edit_page_image;

        if (!empty($image) ) {

            $destinationPath = public_path('images/page');
            $Image = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);

            if (!empty($editPageImage) && file_exists(public_path().'/images/page/'.$editPageImage)) {

                unlink(public_path("images/page/").$editPageImage);
            }
        }
        elseif (!empty($editPageImage)) {
            $Image = $editPageImage;
        }
        else
        {
            $Image = null;
        }

        $silwana->update([
            'page'       => $request->page,
            'detail'     => $request->detail,
            'page_id'    => $request->page_id,
            'page_image' => $Image,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        /* Insert Page details data */

        $pageDetail  = SilwanaDetailMapping::where('silwana_detail_id' , $request->silwana_detail_id)->get();

        if (!empty($pageDetail)) {
            foreach ($pageDetail as $row) {

                 if ( (!in_array($row['silwana_dtl_mpg_id'] , $request->silwana_dtl_mpg_id))) {

                     if (!empty($row['heading_image']) && file_exists(public_path().'/images/heading/'.$row['heading_image'])) {
                         unlink(public_path("images/heading/").$row['heading_image']);
                     }
                     SilwanaDetailMapping::where('silwana_dtl_mpg_id', $row['silwana_dtl_mpg_id'] )->delete();
                 }
            }
        }


        if(!empty($request->silwana_dtl_mpg_id)){
            for ($i = 0; $i < count($request->silwana_dtl_mpg_id); $i++) {
                $SilwanaDetailMapping = SilwanaDetailMapping::find($request->silwana_dtl_mpg_id[$i]);

                if( $request->edit_heading_image ){
                    $editHeadingImage = $request->edit_heading_image[$i];
                }
                else{
                    $editHeadingImage =  '';
                }

                $headingImage = $request->file('heading_image');

                if (isset($headingImage)) {
                    if (array_key_exists($i, $headingImage)) {
                        $headingImage = $request->file('heading_image')[$i];
                        $destinationPath = public_path('images/heading');
                        $subHeadingImage = date('YmdHis') . "." . $headingImage->getClientOriginalName();
                        $headingImage->move($destinationPath, $subHeadingImage);
                        if (!empty($editHeadingImage) && file_exists(public_path() . '/images/heading/' . $editHeadingImage)) {
                             unlink(public_path("images/heading/") . $editHeadingImage);
                        }
                    } else {
                        $subHeadingImage = $editHeadingImage;
                    }


                } elseif (!empty($editHeadingImage)) {
                    $subHeadingImage = $editHeadingImage;
                } else {
                    $subHeadingImage = null;
                }

                $pageDetail = [
                    'silwana_detail_id' => $request->silwana_detail_id,
                    'silwana_dtl_mpg_id' => $request->silwana_dtl_mpg_id[$i],
                    'modified_by' => $userID,
                    'icon' => $request->icon[$i],
                    'heading' => $request->heading[$i],
                    'heading_detail' => $request->heading_detail[$i],
                    'heading_image' => $subHeadingImage
                ];

                if (!empty($request->silwana_dtl_mpg_id[$i])) {
                    $SilwanaDetailMapping->update($pageDetail);
                } else {
                    SilwanaDetailMapping::insert($pageDetail);
                }
            }

        }

        return redirect()->route('admin.silwana')->with('updated','Silwana Details Updated 👍');
    }

    /**
     * Delete Data
     *
     * @return array
     */

    public function delete($id)
    {
        $data = Silwana::find($id);
        $userID   = auth()->user()->id;
        $data->update([
            'deleted'  => 1,  //Deleted
            'deleted_date'  => now(),
            'deleted_by'    =>  $userID,
        ]);
       /* $data =  Silwana::where('silwana_detail_id', '=', $id)->get()->first();

        if ( !empty($data->page_image) && file_exists(public_path().'/images/page/'.$data->page_image)){
            unlink("images/page/".$data->page_image);
        }
       $data->delete();

        $silwanaDetailMap = SilwanaDetailMapping::where('silwana_detail_id','=', $id)->get();

        if (!empty($silwanaDetailMap)) {

            foreach ($silwanaDetailMap as $row) {

                if ( !empty($row->heading_image) && file_exists(public_path().'/images/heading/'.$row->heading_image) ){
                   unlink("images/heading/".$row->heading_image);

                }
            }
             $silwanaDetailMap->each->delete();
        }*/
        return redirect()->route('admin.silwana')->with('success','Page Deleted');
    }

    /**
     * Change status
     *
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Request $request)
    {
        $silwanaPage = Silwana::find($request->id);

        $userID   = auth()->user()->id;
        $status   =  ( !empty($silwanaPage->status) && $silwanaPage->status == 1 ) ?  2 :  1 ;

        $silwanaPage->update([
            'status' => $status,
            'modified_by'   =>  $userID,
            'modified_date' => now()
        ]);

        $silwanaDetailMap = SilwanaDetailMapping::where('silwana_detail_id', '=', $request->id)->first();
        $silwanaDetailMap->status =  $status;
        $silwanaDetailMap->modified_by =  $userID;
        $silwanaDetailMap->modified_date =  now();
        $silwanaDetailMap->save();

        return redirect()->route('admin.silwana')->with('success','Page Status Changed');
    }
}
