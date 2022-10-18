<?php

use App\Models\{Amenities, Category, Project, Block, Silwana,SilwanaDetailMapping,ContactUs};
use App\Models\{FloorUnitMapping, ProjectImage, ProjUnitImage};
use App\Models\{Booking, Project_address_detail,BlockFloorMapping};
use Illuminate\Support\Facades\DB;

if(!function_exists("getCategory")){

    function getCategory() {

        $categoryData = Category::select([ 'category_id','category_name','category_image','status'])
            ->where('deleted',0)
            ->where('status' , 1)
            ->orderBy("category_name",'ASC')->get();
        return $categoryData;

    }
}

if(!function_exists("getAmenities")){

    function getAmenities() {

        $amenitiesData =Amenities::select([ 'amenities_id','amenity_name','amenity_image'])
            ->where('status' , 1)
            ->where('deleted',0)
            ->orderBy("amenity_name",'ASC')
            ->get();
         return $amenitiesData;

    }
}

if(!function_exists("getProject")){

    function getProject() {

        $projectData  = Project::select([ 'project_id','project_name','status'])
            ->where('status' , 1)
            ->where('deleted',0)
            ->orderBy("project_name",'ASC')
            ->get();
        return $projectData;

    }
}

if(!function_exists("getBlock")){

    function getBlock() {

        $projectData  = Block::select([ 'proj_block_map_id','block_name','status'])
            ->where('status' , 1)
            ->where('deleted',0)
            ->orderBy("block_name",'ASC')
            ->get();
        return $projectData;

    }
}

if(!function_exists("getSilwanaPages")) {

    function getSilwanaPages($page_id)
    {

        $data = Silwana::select(['silwana_detail_id', 'page', 'detail', 'page_image'])
            ->where('status', 1)
            ->where('deleted', 0)
            ->where('page_id', $page_id)
            ->get()
            ->first();

        if (!empty($data['silwana_detail_id'])) {
            $data['page_details'] = SilwanaDetailMapping::select(['silwana_dtl_mpg_id', 'icon', 'heading', 'heading_detail', 'heading_image'])
                ->where('status', 1)
                ->where('silwana_detail_id', $data['silwana_detail_id'])
                ->get();
        }

        return $data;
    }
}

if(!function_exists("getContactUsDetail")){

        function getContactUsDetail() {

            $data  = ContactUs::select(['contactus_id','title','desc','notes','image'])
                ->where('status' , 1)
                ->where('deleted',0)
                ->get();

            return $data;
        }
    }

if(!function_exists("getBookingDetail")){

    function getBookingDetail($user_id) {

        $select =  [
            'bookings.booking_id',
            'bookings.canceled',
            'proj_floor_unit_mapping.proj_floor_unit_id',
            'proj_floor_unit_mapping.unit_name',
            'proj_floor_unit_mapping.area_in_sq_feet',
            'proj_floor_unit_mapping.total_price',
            'proj_floor_unit_mapping.booking_price',
            'proj_floor_unit_mapping.booking_type',
           'proj_floor_unit_mapping.rooms',
            'category_master.category_name',
           'proj_block_mappings.block_name',
            'project_master.project_name',
           'project_master.project_detail',

        ];
        $data =  Booking::leftJoin('proj_floor_unit_mapping', 'proj_floor_unit_mapping.proj_floor_unit_id', '=', 'bookings.unit_id')
            ->leftJoin('proj_block_mappings', 'proj_block_mappings.proj_block_map_id', '=', 'proj_floor_unit_mapping.proj_block_floor_id')
            ->leftJoin('project_master', 'project_master.project_id', '=', 'proj_block_mappings.project_id')
           ->leftJoin('category_master', 'category_master.category_id', '=', 'proj_floor_unit_mapping.category_id')
             ->select($select)
            ->orderBy('bookings.booking_id', 'desc')
            ->where('bookings.user_id',$user_id)
            ->get();

        return $data;
    }

}


if(!function_exists("getBookingImage")) {

    function getBookingImage($unit_id) {

            $data  = ProjUnitImage::select(['title', 'path'])
                ->where('proj_floor_unit_id', $unit_id)
                ->get() ;

            return $data;

    }
}


if(!function_exists("getProjectList")) {

    function getProjectList($project_id='' ) {

        $select =  [ 'project_master.project_id',
            'project_master.project_name',
            'project_master.project_detail',
            'project_master.work_status',
            'project_master.status',
            'project_master.created_date',
            'category_master.category_name',
            'project_master.created_date',
            'project_address_details.address',
            'project_address_details.landmark',
            'project_address_details.country',
            'project_address_details.state',
            'project_address_details.city',
            'project_address_details.zip',
        ];

       if (!empty($project_id)) {
           $data = Project::leftJoin('category_master', 'category_master.category_id', '=', 'project_master.category_id')
               //->leftJoin('proj_ameni_mappings', 'proj_ameni_mappings.project_id', '=', 'project_master.project_id')
               ->leftJoin('project_address_details','project_address_details.project_id' , '=', 'project_master.project_id')
               ->select($select)
               ->where('project_master.deleted',0)
               ->where('project_master.project_id', $project_id)
               ->orderBy('project_master.project_id', 'desc')
               ->get()->first();
       } else {
           $data = Project::leftJoin('category_master', 'category_master.category_id', '=', 'project_master.category_id')
               //->leftJoin('proj_ameni_mappings', 'proj_ameni_mappings.project_id', '=', 'project_master.project_id')
               ->leftJoin('project_address_details','project_address_details.project_id' , '=', 'project_master.project_id')
               ->select($select)
               ->where('project_master.deleted',0)
               ->orderBy('project_master.project_id', 'desc')
               ->get();
       }

        return $data;
    }

}


if(!function_exists("getProjectAddress")) {

    function getProjectAddress($project_id) {

        $select =  [
            'project_address_details.address',
            DB::raw("CONCAT(project_address_details.address, ' ', project_address_details.landmark, ' ',  countries.name , ' ', states.name , ' ', cities.name )  AS address"),
            'project_address_details.zip',
        ];
        $data = Project_address_detail::leftJoin('countries', 'countries.id', '=', 'project_address_details.country')
            ->leftJoin('states', 'states.id', '=', 'project_address_details.state')
            ->leftJoin('cities','cities.id' , '=', 'project_address_details.city')
            ->select($select)
            ->where('project_address_details.project_id',$project_id)
            ->get()->first();

        return $data;
    }
}

if (!function_exists("getProjectImage")) {

    function getProjectImage($project_id,$obj = '') {

        $select = ['project_image_id', 'title','path','type' ,'direction','facing'];

        if (!empty($obj)) {
            $data = ProjectImage::select($select)
                ->where('project_id' ,  $project_id)
                ->get()
                ->first();
        } else {
            $data = ProjectImage::select($select)
                ->where('project_id' ,  $project_id)
                ->get()->toArray();
        }

        return $data;
    }
}

if(!function_exists("getPropertyList")) {

    function getPropertyList($property_id='') {

        $select =  [
            'project_master.project_id',
            'project_master.project_name',
            'project_master.project_detail',
            'proj_floor_unit_mapping.proj_floor_unit_id',
            'proj_floor_unit_mapping.unit_name',
            'proj_floor_unit_mapping.area_in_sq_feet',
            'proj_floor_unit_mapping.rooms',
            'proj_floor_unit_mapping.total_price',
            'proj_floor_unit_mapping.booking_price',
            'proj_floor_unit_mapping.facing',
            'proj_floor_unit_mapping.overlooking',
            'proj_floor_unit_mapping.booking_type',
            'proj_floor_unit_mapping.status',
            'category_master.category_name',
            'proj_block_mappings.block_name'
        ];

        if (!empty($property_id ))  {
            $data = FloorUnitMapping::leftJoin('category_master', 'category_master.category_id', '=', 'proj_floor_unit_mapping.category_id')
                    ->leftJoin('proj_block_mappings', 'proj_block_mappings.proj_block_map_id', '=', 'proj_floor_unit_mapping.proj_block_floor_id')
                    ->leftJoin('project_master', 'project_master.project_id', '=', 'proj_block_mappings.project_id')
                    ->select($select)
                    ->orderBy('proj_floor_unit_mapping.proj_floor_unit_id', 'desc')
                    ->where('proj_floor_unit_mapping.deleted',0)
                    ->where('proj_floor_unit_mapping.proj_floor_unit_id',$property_id)
                    ->get()->first();
        }
        else {
            $data = FloorUnitMapping::leftJoin('category_master', 'category_master.category_id', '=', 'proj_floor_unit_mapping.category_id')
                    ->leftJoin('proj_block_mappings', 'proj_block_mappings.proj_block_map_id', '=', 'proj_floor_unit_mapping.proj_block_floor_id')
                    ->leftJoin('project_master', 'project_master.project_id', '=', 'proj_block_mappings.project_id')
                    ->select($select)
                    ->orderBy('proj_floor_unit_mapping.proj_floor_unit_id', 'desc')
                    ->where('proj_floor_unit_mapping.deleted',0)
                    ->get();
        }

        return $data;
    }
}

if(!function_exists('getPropertyImage')) {

    function getPropertyImage($unit_id,$single='')
    {

        if(!empty($single)){
            $data = ProjUnitImage::select([ 'title','path'])
                ->where('proj_floor_unit_id' ,  $unit_id)
                ->get()->first();
        }else{
            $data = ProjUnitImage::select([ 'title','path'])
                ->where('proj_floor_unit_id' ,  $unit_id)
                ->get()->toArray();
        }
        return $data;
    }
}


if(!function_exists("getTopCategories")) {

    function getTopCategories() {

        $select =  [
            'project_master.project_id',
            'project_master.project_name',
            'project_master.project_detail',
            'proj_floor_unit_mapping.proj_floor_unit_id',
            'proj_floor_unit_mapping.unit_name',
            'proj_floor_unit_mapping.area_in_sq_feet',
            'proj_floor_unit_mapping.rooms',
            'proj_floor_unit_mapping.total_price',
            'proj_floor_unit_mapping.booking_price',
            'proj_floor_unit_mapping.facing',
            'proj_floor_unit_mapping.overlooking',
            'proj_floor_unit_mapping.status',
            'category_master.category_name',
            'proj_block_mappings.block_name'
        ];

        if (!empty($property_id ))  {
            $data = Category::leftJoin('category_master', 'category_master.category_id', '=', 'proj_floor_unit_mapping.category_id')
                ->leftJoin('proj_block_mappings', 'proj_block_mappings.proj_block_map_id', '=', 'proj_floor_unit_mapping.proj_block_floor_id')
                ->leftJoin('project_master', 'project_master.project_id', '=', 'proj_block_mappings.project_id')
                ->select($select)
                ->orderBy('proj_floor_unit_mapping.proj_floor_unit_id', 'desc')
                ->where('proj_floor_unit_mapping.deleted',0)
                ->where('proj_floor_unit_mapping.proj_floor_unit_id',$property_id)
                ->get()->first();
        }
        else {
            $data = FloorUnitMapping::leftJoin('category_master', 'category_master.category_id', '=', 'proj_floor_unit_mapping.category_id')
                ->leftJoin('proj_block_mappings', 'proj_block_mappings.proj_block_map_id', '=', 'proj_floor_unit_mapping.proj_block_floor_id')
                ->leftJoin('project_master', 'project_master.project_id', '=', 'proj_block_mappings.project_id')
                ->select($select)
                ->orderBy('proj_floor_unit_mapping.proj_floor_unit_id', 'desc')
                ->where('proj_floor_unit_mapping.deleted',0)
                ->get();
        }

        return $data;
    }

}

if(!function_exists('getBlockFloorByUnit')) {

    function getBlockFloorByUnit($unit_id)
    {
        $select =  [
            'proj_block_mappings.proj_block_map_id',
            'project_master.project_id',
            'project_master.project_name',
            'proj_floor_unit_mapping.unit_name',
            'proj_block_floor_dtl.floor_no',
            'proj_block_mappings.proj_block_map_id',
            'proj_block_mappings.block_name'
        ];

        $data = FloorUnitMapping::leftJoin('proj_block_floor_dtl', 'proj_block_floor_dtl.proj_block_floor_id', '=', 'proj_floor_unit_mapping.proj_block_floor_id')
            ->leftJoin('proj_block_mappings', 'proj_block_mappings.proj_block_map_id', '=', 'proj_block_floor_dtl.proj_block_mapg_id')
            ->leftJoin('project_master', 'project_master.project_id', '=', 'proj_block_mappings.project_id')
            ->select($select)
            //    ->orderBy('proj_floor_unit_mapping.proj_floor_unit_id', 'ASCs')
            ->where('proj_floor_unit_mapping.deleted',0)
            ->where('proj_floor_unit_mapping.proj_floor_unit_id',$unit_id)
            ->get()->first();


        return $data;
    }
}


if(!function_exists("getBlockData")) {

    function getBlockData($project_id) {

        $data = Block::select([ 'block_name','proj_block_map_id'])
            ->where('project_id' ,  $project_id)
            ->get();
        return $data;
    }
}
if(!function_exists("getFloor")) {

    function getFloor($block_id)
    {
        $data  = BlockFloorMapping::where("proj_block_mapg_id", $block_id)->get(["proj_block_floor_id", "floor_no"]);

        return $data;
    }
}
if(!function_exists("getUnit")) {

    function getUnit($floor_id)
    {
        $data = FloorUnitMapping::where("proj_block_floor_id", $floor_id)->get(["proj_floor_unit_id", "unit_name"]);
        return $data;
    }
}
