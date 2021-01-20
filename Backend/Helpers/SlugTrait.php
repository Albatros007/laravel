<?php


namespace App\Backend\Helpers;


trait SlugTrait
{
    protected function setSlug()
    {
        if ($this->auto_slug) {

            $slug = \Illuminate\Support\Str::slug($this->title);
            $this->merge([
                'slug' => $slug,
            ]);

            $this->session()->flash('__slug', $slug);
        }
    }
}
