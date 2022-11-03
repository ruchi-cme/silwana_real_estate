<?php

use App\Models\{Amenities, Category, Project, Block, Silwana,SilwanaDetailMapping,ContactUs};
use App\Models\{FloorUnitMapping, ProjectImage, ProjUnitImage, FloorDetail,Proj_ameni_mapping};
use App\Models\{Block_name_mapping, Booking, Project_address_detail, BlockFloorMapping,Builder};
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

if(!function_exists("getAmenitiesByProject")){

    function getAmenitiesByProject($project_id) {
        $select =  [
            'amenities_master.amenities_id','amenities_master.amenity_name','amenities_master.amenity_image'
        ];
        $amenitiesData =Proj_ameni_mapping::leftJoin('amenities_master', 'amenities_master.amenities_id', '=', 'proj_ameni_mappings.amenities_id')
            ->select($select)
            ->where('proj_ameni_mappings.project_id',$project_id)
            ->where('amenities_master.status' , 1)
            ->where('amenities_master.deleted',0)
            ->orderBy("amenities_master.amenity_name",'ASC')
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

    function getBookingDetail($user_id ='',$booking_id='') {

        $select =  [
            'bookings.booking_id',
            'bookings.canceled',
            'bookings.project_id',
            'bookings.status',
            'floor_unit_mapping.floor_unit_id',
            'floor_unit_mapping.unit_name',
            'floor_unit_mapping.area_in_sq_feet',
            'floor_unit_mapping.total_price',
            'floor_unit_mapping.booking_price',
            'floor_unit_mapping.booking_type',
            'category_master.category_name',
            'project_master.project_name',
           'project_master.project_detail',
            'block_floor_mappings.block_name_map_id',
            'block_floor_mappings.block_floor_map_id',
            'floor_details.floor_no',
            'block_name_mappings.block_name'
        ];

        if(!empty($user_id)){
            $data =  Booking::leftJoin('floor_unit_mapping', 'floor_unit_mapping.floor_unit_id', '=', 'bookings.unit_id')
                ->leftJoin('project_master', 'project_master.project_id', '=', 'bookings.project_id')
                ->leftJoin('category_master', 'category_master.category_id', '=', 'project_master.category_id')
                ->leftJoin('floor_details', 'floor_details.floor_detail_id', '=', 'floor_unit_mapping.floor_detail_id')
                ->leftJoin('block_floor_mappings', 'block_floor_mappings.block_floor_map_id', '=', 'floor_details.block_floor_map_id')
                ->leftJoin('block_name_mappings', 'block_name_mappings.block_name_map_id', '=', 'block_floor_mappings.block_name_map_id')
                ->select($select)
                ->orderBy('bookings.booking_id', 'desc')
                ->where('bookings.user_id',$user_id)
                ->get();
        }
        elseif(!empty($booking_id)){
                $data =  Booking::leftJoin('floor_unit_mapping', 'floor_unit_mapping.floor_unit_id', '=', 'bookings.unit_id')
                    ->leftJoin('project_master', 'project_master.project_id', '=', 'bookings.project_id')
                    ->leftJoin('category_master', 'category_master.category_id', '=', 'project_master.category_id')
                    ->leftJoin('floor_details', 'floor_details.floor_detail_id', '=', 'floor_unit_mapping.floor_detail_id')
                    ->leftJoin('block_floor_mappings', 'block_floor_mappings.block_floor_map_id', '=', 'floor_details.block_floor_map_id')
                    ->leftJoin('block_name_mappings', 'block_name_mappings.block_name_map_id', '=', 'block_floor_mappings.block_name_map_id')
                    ->select($select)
                    ->orderBy('bookings.booking_id', 'desc')
                    ->where('bookings.booking_id',$booking_id)
                    ->get()->first();
            }

        else {
            $data =  Booking::leftJoin('floor_unit_mapping', 'floor_unit_mapping.floor_unit_id', '=', 'bookings.unit_id')
                ->leftJoin('project_master', 'project_master.project_id', '=', 'bookings.project_id')
                ->leftJoin('category_master', 'category_master.category_id', '=', 'project_master.category_id')
                ->leftJoin('floor_details', 'floor_details.floor_detail_id', '=', 'floor_unit_mapping.floor_detail_id')
                ->leftJoin('block_floor_mappings', 'block_floor_mappings.block_floor_map_id', '=', 'floor_details.block_floor_map_id')

                ->leftJoin('block_name_mappings', 'block_name_mappings.block_name_map_id', '=', 'block_floor_mappings.block_name_map_id')
                ->select($select)
                ->orderBy('bookings.booking_id', 'desc')
                ->get();
        }


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

    function getProjectList($project_id='' ,$work_status ='',$search='') {

        $select =  [ 'project_master.project_id',
            'project_master.project_name',
            'project_master.project_detail',
            'project_master.work_status',
            'project_master.status',
            'project_master.created_date',
            'category_master.category_name',
            'project_master.project_id',
            'project_master.created_date',
            'project_address_details.address',
            'project_address_details.landmark',
            'project_address_details.country',
            'project_address_details.state',
            'project_address_details.city',
            'project_address_details.zip',
            'project_address_details.latitude',
            'project_address_details.longitude'
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
               ->where('project_master.work_status',$work_status)
               ->where('project_master.project_name', 'like', '%'. $search .'%')
               ->orderBy('project_master.project_id', 'desc')
              // ->get();
               ->paginate(10);
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
            'floor_unit_mapping.floor_unit_id',
            'floor_unit_mapping.unit_name',
            'floor_unit_mapping.area_in_sq_feet',
            'floor_unit_mapping.total_price',
            'floor_unit_mapping.booking_price',
            'floor_unit_mapping.total_price',
            'floor_details.floor_detail_id' ,
            'floor_details.category_id' ,
            'floor_details.floor_no' ,
            'floor_details.project_id' ,
            'block_floor_mappings.block_name_map_id',
            'block_floor_mappings.block_floor_map_id'
        ];
        if (!empty($property_id )) {
        $data = FloorUnitMapping::leftJoin('floor_details', 'floor_details.floor_detail_id', '=', 'floor_unit_mapping.floor_detail_id')
            ->leftJoin('block_floor_mappings', 'block_floor_mappings.block_floor_map_id', '=', 'floor_details.block_floor_map_id')
            ->select($select)
            ->where('floor_unit_mapping.floor_unit_id',$property_id)
            ->get()->first();
        }
        else {
            $data = FloorUnitMapping::leftJoin('floor_details', 'floor_details.floor_detail_id', '=', 'floor_unit_mapping.floor_detail_id')
                ->leftJoin('block_floor_mappings', 'block_floor_mappings.block_floor_map_id', '=', 'floor_details.block_floor_map_id')
                ->select($select)
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

        $data = Block_name_mapping::where("project_id",$project_id)
            ->where("status",1)
            ->where("deleted",0)
            ->get(["block_name", "block_name_map_id"]);;
        return  $data ;
    }
}

//new
if(!function_exists("getFloor")) {

    function getFloor($block_id)
    {
        $select = ['floor_details.floor_detail_id','floor_details.floor_no'];
        $data  = BlockFloorMapping::leftJoin('floor_details', 'floor_details.block_floor_map_id', '=', 'block_floor_mappings.block_floor_map_id')
            ->select($select)
            ->where('block_floor_mappings.block_name_map_id',$block_id)
            ->orderBy('floor_details.floor_no','ASC')
            ->get();
        return $data;
    }
}

if(!function_exists("getUnit")) {

    function getUnit($floor_id,$booking_type='')
    {

        if(!empty($booking_type)){
            $data = FloorUnitMapping::where("floor_detail_id", $floor_id)->where('booking_type',$booking_type)
                ->get(["floor_unit_id", "floor_detail_id", "unit_name","area_in_sq_feet" , "total_price", "booking_price"])
                ->toArray();
        } else {
            $data = FloorUnitMapping::where("floor_detail_id", $floor_id)
                ->get(["floor_unit_id", "floor_detail_id", "unit_name","area_in_sq_feet" , "total_price", "booking_price"])
                ->toArray();
        }

        return $data;
    }
}

if(!function_exists("getUnitData")) {

    function getUnitData($unit_id)
    {
        $data = FloorUnitMapping::where("floor_unit_id", $unit_id)
            ->get(["floor_unit_id", "floor_detail_id", "unit_name","area_in_sq_feet" , "total_price", "booking_price"])
            ->first();
        return $data;
    }
}


if(!function_exists("getCountCategoryProject")){

    function getCountCategoryProject($category_id) {

        $projectData  = Project::select([ 'project_id'])
            ->where('status' , 1)
            ->where('deleted',0)
            ->where('category_id',$category_id)
            ->get();
        $countProject = $projectData->count();
        return $countProject;

    }
}

if(!function_exists("getpropertyDetailsByProject")){

    function getpropertyDetailsByProject($project_id) {

        $select = [ DB::raw('max(floor_unit_mapping.booking_price) as max,   min(floor_unit_mapping.booking_price) as min')];
        $projectData  = FloorDetail::leftJoin('floor_unit_mapping', 'floor_unit_mapping.floor_detail_id', '=', 'floor_details.floor_detail_id')
            ->select($select)
            ->where('floor_details.project_id',$project_id)
            ->get()->first();

        return $projectData;
    }
}
if(!function_exists("getBuilderDetail")){

    function getBuilderDetail() {

        $builderDetail = Builder::select([ 'builder_id','phone_number','builder_email','company_name'])
            ->where('deleted',0)
            ->where('status' , 1)
             ->get()->first();
        return $builderDetail;

    }
}
