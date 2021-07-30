<?php

namespace App\Http\Resources\Auction;

use Illuminate\Http\Resources\Json\JsonResource;

class AuctionResourceCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "auction" => new AuctionResource($this),
            "user" => [
                'fullname' => $this->user->fullname,
                'email' => $this->user->email,
                'call_up_no' => $this->user->call_up_no,
                'verified' => is_null($this->user->email_verified_at) ? 'no' : 'yes',
                'created_at' => $this->created_at->format('Y-m-d H:i:s')
            ]
        ];
    }
}
