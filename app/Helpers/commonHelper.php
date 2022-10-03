<?php

use App\Models\{Amenities, Category, Project, Block};


if(!function_exists("getCategory")){

    function getCategory() {

        $categoryData = Category::select([ 'category_id','category_name','status'])
            ->where('deleted',0)
            ->where('status' , 1)
            ->orderBy("category_name",'ASC')->get();
        return $categoryData;

    }
}

if(!function_exists("getAmenities")){

    function getAmenities() {

        $amenitiesData =Amenities::select([ 'amenities_id','amenity_name'])
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

