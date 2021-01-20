<?php

namespace App\Backend\Requests\Post;

use App\Backend\Helpers\SlugTrait;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class PostRequest extends FormRequest
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
            //'slug' => 'unique:'.Post::getTableName().',slug,'.Request::route('post').'|min:'.self::$rulesParams['strMin'].'|max:'.self::$rulesParams['strMax'],
            //'is_hidden' => 'boolean'
        ];
    }
}
