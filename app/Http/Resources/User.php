<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'lastname' => $this->lastname,
            'othernames' => $this->othernames,
            'email' => $this->email,
            'phone' => $this->phone,
            'dob' => $this->dob,
            'hire_date' => $this->hire_date,
            'address' => $this->address,
            'employee_id' => $this->employee_id,
            'country_id' => $this->country_id,
            'country' => $this->country,
            'state_id' => $this->state_id,
            'state' => $this->state,
            'city_id' => $this->city_id,
            'city' => $this->city,
            'photo' => $this->photo,
            'reports_to' => $this->reports_to,
            'role_id' => $this->role_id,
            'role' => $this->role,
            'gender_id' => $this->gender_id,
            'gender' => $this->gender,
            'guarantors' => $this->guarantors,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }
}
