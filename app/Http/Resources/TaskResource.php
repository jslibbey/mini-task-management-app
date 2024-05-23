<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'last_status_update_at' => $this->last_status_update_at,
            'assignee_id' => $this->assignee_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'sub_tasks' => TaskResource::collection($this->whenLoaded('subTasks')),
            'assignee' => new UserResource($this->whenLoaded('assignee')),
        ];
    }
}
