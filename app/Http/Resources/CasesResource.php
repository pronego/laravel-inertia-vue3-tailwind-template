<?php
/**
 * @copyright (c) 2023 ${PROJECT_NAME}
 * @author    Dr. Manuel Lamotte-Schubert, pronego (https://www.pronego.com)
 * @date      2023-09-22 23:00
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Cases */
class CasesResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'name' => $this->name,
            'entry' => $this->entry,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
