<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utility\UtilityFunction;
use App\Http\Utility\ValidationUtil;
use App\Models\User;
use Illuminate\Support\Str;

class MechanicController extends Controller
{
    use UtilityFunction, ValidationUtil;
    //image upload path set for works images
    protected $imagePath = 'images/mechanic';
    protected $imageSizes = [
        'thumb' => [200,200],
    ];
    
    /**
     * For showing mechanic view
     *
     * @return View responce blade view with data
     */
    public function index(Request $request)
    {
        return view('admin.modules.mechanic.list', [
            "name" => $request->name,
            "offset" => $request->offset,
            "q" => $request->q,
        ]);
    }

    /**
     * For getting mechanic listing
     *
     * @param Request $request request body from client
     * @return Json responce data with http responce code
     */
    public function listMechanic(Request $request)
    {
        $query = User::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->where('role_id', 3)->orderBy('id', 'desc')->paginate($offset);

        $data = [
            'rows' => view('admin.modules.mechanic.list_rows',
                [
                    'items' => $items,
                ]
            )->render(),
            'items' => $items,
            'pagination' => view('admin.inc.pagination', ['result' => $items])->render(),
        ];
        return response()->json($data, 200);
    }

    /**
     * For showing mechanic create view
     *
     * @param Integer $id id of group
     * @return View responce blade with data
     */
    public function create()
    {
        return view('admin.modules.mechanic.add', [
            "item" => false,
            "country_codes" => json_decode(\Storage::disk('local')->get('data/country_code_json.json')),
        ]);
    }

    /**
     * For updating mechanic data
     *
     * @param Request $request request body from client
     * @return Json responce data with http responce code
     */
    public function store(Request $request)
    {
        $valid = $this->storeMechanicValidAdmin($request);
        if ($valid) {
            return $valid;
        }

        if ($request->id) {
            $item = User::find($request->id);
        } else {
            $item = new User();
        }
        $item->role_id = 3;
        $item->first_name = $request->first_name;
        $item->last_name = $request->last_name;
        $item->email = $request->email;
        $item->country_code = $request->country_code;
        $item->mobile = $request->mobile;
        $item->profile_image = $request->image;
        $item->save();
        return response()->json([
            'success' => true,
            'message' => $request->id ? 'Mechanic Updated' : 'Mechanic Added',
            'redirect' => route('mechanic.index'),
        ]);
    }

    /**
     * For showing mechanic edit view
     *
     * @param Integer $id id of group
     * @return View responce blade with data
     */
    public function edit($id)
    {
        return view('admin.modules.mechanic.add', [
            "item" => User::find($id),
            "country_codes" => json_decode(\Storage::disk('local')->get('data/country_code_json.json')),
        ]);
    }

    /**
     * For deleting the mechanic
     *
     * @param Request $request request body from client
     * @return Json responce data with http responce code
     */
    public function delete(Request $request)
    {
        User::find($request->id)->delete();
        return response()->json([
            'message' => 'Deleted Successfully!',
        ], 200);
    }

    /**
     * For changing the mechanic status
     *
     * @param Request $request request body from client
     * @return Json responce data with http responce code
     */
    public function status(Request $request)
    {
        $item = User::find($request->id);
        $item->status = !$item->status;
        $item->save();

        return response()->json([
            'message' => 'Status Changed Successfully',
        ], 200);
    }

    /**
     * For uploading user image
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
           
            return response()->json([
                'message' => 'Image Uploaded.',
                'thumb_image' => asset('storage/app/' . $this->imagePath . '/' . $image_new),
                'image' => $image_new,
            ]);

        }
    }
}
