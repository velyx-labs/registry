<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComponentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $includeFiles = $request->query('include') === 'files';

        return [
            'name' => $this->resource['name'],
            'version' => $this->resource['version'],
            'latest' => $this->resource['latest'],
            'versions' => $this->resource['versions'],
            'description' => $this->resource['meta']['description'],
            'requires_alpine' => $this->resource['meta']['requires_alpine'],
            'requires' => $this->resource['meta']['requires'],
            'categories' => $this->resource['meta']['categories'],
            'files' => $includeFiles ? $this->resource['files'] : [],
            'laravel' => $this->resource['meta']['laravel'],
        ];
    }
}
