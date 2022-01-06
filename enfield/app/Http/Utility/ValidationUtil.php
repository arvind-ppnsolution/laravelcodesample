<?php
namespace App\Http\Utility;

use App\Models\Products;
use App\Rules\ValidEndDate;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

trait ValidationUtil
{

    /**
     * For validation of Admin/PasswordController changePasswordSubmit() function
     *
     * @param Request $request request body from client
     * @return Validator failed validation response
     * @return Boolean false when all the validations passes
     */
    protected function changePasswordSubmitPasswordValidAdmin($request)
    {
        $this->validate($request, [
            'current_pwd' => 'required|min:8',
            'password' => 'required|min:8|max:12|confirmed',
            'password_confirmation' => 'required|max:255',
        ], [
            'current_pwd.required' => 'The Current password is required',
            'current_pwd.min' => 'The Current password should be minimum 8 characters',
            'password.confirmed' => "The Password doesn't match",
        ]);
    }

    /**
     * For validation of Admin/ProfileController update() function
     *
     * @param Request $request request body from client
     * @return Validator failed validation response
     * @return Boolean false when all the validations passes
     */
    protected function updateProfileValidAdmin($request)
    {
        $this->validate($request, [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u|max:25',
            'email' => 'required|email|unique:users,email,NULL,id,role_id,2,id,' . \Auth::id(),
            'mobile' => 'required|numeric|digits_between:4,15',
        ]);
    }

    /**
     * For validation of Admin/ProfileController uploadSingleImage() function
     *
     * @param Request $request request body from client
     * @return Validator failed validation response
     * @return Boolean false when all the validations passes
     */
    protected function uploadSingleImageProfileValidAdmin($request)
    {
        if ($request->width) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:20480',
            ], [
                'image.image' => 'Image should be JPEG, PNG or JPG',
                'image.mimes' => 'Image should be JPEG, PNG or JPG',
            ]);
        } else {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:20480|dimensions:width=' . $request->width . ',height=' . $request->height,
            ], [
                'image.image' => 'Image should be JPEG, PNG or JPG',
                'image.mimes' => 'Image should be JPEG, PNG or JPG',
            ]);
        }
    }

    /**
     * For validation of Api/Auth/LoginController uploadImage() function
     *
     * @param Request $request request body from client
     * @return Validator failed validation response
     * @return Boolean false when all the validations passes
     */
    protected function uploadImageProfileValidApi($request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:20480',
        ], [
            'image.image' => 'Image should be JPEG, PNG or JPG',
            'image.mimes' => 'Image should be JPEG, PNG or JPG',
        ]);

    }

    /**
     * For validation of Admin/RegistrationController login() function
     *
     * @param Request $request request body from client
     * @return Validator failed validation response
     * @return Boolean false when all the validations passes
     */
    protected function loginRegistrationValidAdmin($request)
    {
        $email_regex = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix';
        $this->validate($request, [
            'email' => 'required|email|regex:' . $email_regex . '|max:255',
            'password' => 'required|min:6|max:20',
        ]);
    }

    /**
     * For validation of Admin/MechanicController store() function
     *
     * @param Request $request request body from client
     * @return Validator failed validation response
     * @return Boolean false when all the validations passes
     */
    protected function storeMechanicValidAdmin($request)
    {
        $this->validate($request, [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u|max:25',
            'email' => 'required|email|unique:users,email,NULL,id,id,' . \Auth::id(),
            'mobile' => 'required|numeric|digits_between:4,15',
        ]);
    }
    
    /**
     * For validation of Api/Auth/LoginController saveContactInfo() function
     *
     * @param Request $request request body from client
     * @return Validator failed validation response
     * @return Boolean false when all the validations passes
     */
    protected function saveContactInfoValidApi($request)
    {
        $regex_url = '/^((https):\/\/)?((http):\/\/)?(www.)?[a-z0-9]+\.[a-z]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/';
        $email_regex = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix';
        $this->validate($request, [
            'mobile' => 'required|digits_between:4,15',
            'professional_email' => 'required|regex:' . $email_regex . '|min:4|max:50',
            'professional_website' => 'required|regex:' . $regex_url . '|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'pinterest' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',

        ], [

        ]);

    }

}
