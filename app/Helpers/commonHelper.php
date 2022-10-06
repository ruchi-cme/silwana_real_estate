<?php

use App\Models\{Amenities, Category, Project, Block, Silwana,SilwanaDetailMapping,ContactUs};


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
