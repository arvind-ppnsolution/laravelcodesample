<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utility\UtilityFunction;
use App\Http\Utility\ValidationUtil;

class ProfileController extends Controller
{
    use UtilityFunction, ValidationUtil;
    //image upload path set for works images
    protected $imagePath = 'images/users';
    protected $imageSizes = [
        'thumb' => [200,200],
    ];

    /**
     * For showing profile view
     *
     * @return View responce blade view with data
     */
    public function index()
    {
        return view('admin.modules.profile.index', [
            "country_codes" => json_decode(\Storage::disk('local')->get('data/country_code_json.json')),
        ]);
    }

    /**
     * For updating profile data
     *
     * @param Request $request request body from client
     * @return Json responce data with http responce code
     */
    public function update(Request $request)
    {
        $valid = $this->updateProfileValidAdmin($request);
        if ($valid) {
            return $valid;
        }

        $user = \Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->country_code = $request->country_code;
        $user->mobile = $request->mobile;
        $user->profile_image = $request->image;
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Profile Updated',
            'redirect' => "javascript: void(0)",
        ]);
    }

    /**
     * For uploading profile image
     *
     * @param Request $request request body from client
     * @return Json responce data with http responce code
     */
    public function uploadSingleImage(Request $request)
    {
        $valid = $this->uploadSingleImageProfileValidAdmin($request);
        if ($valid) {
            return $valid;
        }
        
        $image = $request->file('image');
        $image_new = "";
        if ($image) {
            $image_new = $this->uploadImage($image, $this->imagePath, $this->imageSizes);
            /*$user = \Auth::user();
            $user->profile_image = $image_new;
            $user->save();*/
            return response()->json([
                'message' => 'Image Uploaded.',
                'thumb_image' => asset('storage/app/' . $this->imagePath . '/' . $image_new),
                'image' => $image_new,
            ]);

        }
    }
}
