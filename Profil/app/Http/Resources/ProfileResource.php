<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $values =  parent::toArray($request);
        // add password
        $values['password'] = $this->password;
        //test image 
        if(isset($values['images'])){
            // recuper url image 
            $values['image'] = url('storage/'.$values['image']);
        }
        
        // add name 
        //$values['name'] = 'blabla';
        // create_at d-m-y
        $values['created'] = date_format(date_create($values['created_at']),'d-m-y');
        

        // suppression
        unset($values['created_at'],$values['bio'],$values['id']);
        return $values;
    }
    
    // count  profiles :"count": 4
    public static function collection($resource)
    {
        $values =  parent::collection($resource)->additional([
            'count' => $resource->count()
        ]);
        return ($values);
    }
}
