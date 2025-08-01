<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PublicationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_dokumen' => $this->nama_dokumen,
            'slug' => $this->slug,
            'produsen_data' => $this->produsen_data,
            'rencana_rilis' => $this->rencana_rilis ? Carbon::parse($this->rencana_rilis)->format('Y-m-d') : null,
            'tanggal_rilis' => $this->tanggal_rilis ? Carbon::parse($this->tanggal_rilis)->format('Y-m-d') : null,
            'deskripsi' => $this->deskripsi,
            'image' => $this->image,
            'file' => $this->file,
            'image_url' => asset("storage/{$this->image}"),
            'file_url' => asset("storage/{$this->file}"),
        ];
    }
}
