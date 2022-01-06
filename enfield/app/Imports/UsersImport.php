<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Utility\UtilityFunction;
use App\Models\User;
use App\Models\Countries;
use Hash;

class UsersImport implements ToCollection
{
    use UtilityFunction;
    //image upload path set for works images
    protected $imagePath = 'images/users';
    protected $imageSizes = [
        'thumb' => [200,200],
    ];

    public $id;

    public function  __construct($id)
{
    $this->id = $id;
}

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        if($this->id == 'admin')
            $role_id = 1;
            elseif($this->id == 'skillsfindr')
            $role_id = 2;
            elseif($this->id == 'skillsmaster')
            $role_id = 3;

        foreach ($collection->slice(1) as $row) {
            if(!User::where('email', $row[5])->first()){
                $user = new User();
                $user->role_id = $role_id;
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->first_name = $row[0];
                $user->last_name = $row[1];
                $user->display_name = $row[2];
                $user->country_code = $row[3];
                $user->mobile = $row[4];
                $user->email = $row[5];
                $user->username = $row[6];
                $user->password = Hash::make(date('YmdHis'));
                $user->portfolio_link = $row[7];
                $user->bio = $row[8];
                $user->city = $row[9];
                if($row[10]){
                    if(!Countries::where('name', $row[10])->first()){
                        $country = new Countries();
                        $country->name = $row[10];
                        $country->save();
                    }
                $user->country = Countries::where('name', $row[10])->first()->id;
                }
                $image = $row[11];
                if ($image) {
                    $image_new = $this->uploadImage($image, $this->imagePath, $this->imageSizes);
                    $user->profile_image = $image_new;
                }
                $user->save();
            }
        }
    }
}
