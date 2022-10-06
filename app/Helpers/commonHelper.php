<?php

use App\Models\{Amenities, Category, Project, Block, Silwana,SilwanaDetailMapping,ContactUs};
use App\Models\{FloorUnitMapping,ProjUnitImage };

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

    function getBookingDetail() {

        $select =  [
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
            'project_address_details.address',
            'project_address_details.landmark',
            'project_address_details.country',
            'project_address_details.state',
            'project_address_details.city',
            'project_address_details.zip',
        ];
        $data = FloorUnitMapping::leftJoin('category_master', 'category_master.category_id', '=', 'proj_floor_unit_mapping.category_id')
            ->leftJoin('proj_block_mappings', 'proj_block_mappings.proj_block_map_id', '=', 'proj_floor_unit_mapping.proj_block_floor_id')
            ->leftJoin('project_master', 'project_master.project_id', '=', 'proj_block_mappings.project_id')
            ->leftJoin('project_address_details','project_address_details.project_id' , '=', 'project_master.project_id')
            ->select($select)
            ->orderBy('proj_floor_unit_mapping.proj_floor_unit_id', 'desc')
            ->where('proj_floor_unit_mapping.deleted',0)
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
