<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Blog\Entities\Blog;
use Modules\Core\Http\Requests\Request;

class SaveBlogRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'blog::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
            'slug' => $this->getSlugRules(),
        ];
    }

    private function getSlugRules()
    {
        $rules = $this->route()->getName() === 'admin.blogs.update'
            ? ['required']
            : ['sometimes'];

        $slug = Blog::withoutGlobalScope('active')->where('id', $this->id)->value('slug');

        $rules[] = Rule::unique('blogs', 'slug')->ignore($slug, 'slug');

        return $rules;
    }
}
