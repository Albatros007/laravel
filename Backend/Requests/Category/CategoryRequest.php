<?php

namespace App\Backend\Requests\Category;

use App\Backend\Helpers\SlugTrait;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class CategoryRequest extends FormRequest
{
    use SlugTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

    protected function prepareForValidation()
    {
        /**
         * Method from SlugTrait
         */
        $this->setSlug();
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public static $rulesParams = [
        'strMin' => 3,
        'strMax' => 255
    ];

    public function rules()
    {
        return [
            'title' => 'required|min:'.self::$rulesParams['strMin'].'|max:'.self::$rulesParams['strMax'],
            'slug' => 'unique:'.Category::getTableName().',slug,'.Request::route('category').'|min:'.self::$rulesParams['strMin'].'|max:'.self::$rulesParams['strMax'],
            'meta_keywords' => 'nullable|min:'.self::$rulesParams['strMin'].'|max:'.self::$rulesParams['strMax'],
            'meta_description' => 'nullable|min:'.self::$rulesParams['strMin'].'|max:'.self::$rulesParams['strMax'],
            'is_hidden' => 'boolean'
        ];
    }
}
