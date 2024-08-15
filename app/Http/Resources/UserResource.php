<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $message;

    public function __construct($resource, $message = '')
    {
        parent::__construct($resource);
        $this->message = $message;
    }

    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function with($request)
    {
        return [
            'message' => $this->message,
        ];
    }
}