<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\CategoriesExport;
use App\Exports\CertificationsExport;
use App\Exports\LanguagesExport;
use App\Exports\SkillsExport;
use App\Exports\ProductsExport;
use App\Exports\CountriesExport;
use App\Exports\TypesExport;
use App\Exports\InstitutionsExport;
use App\Exports\IcfsExport;
use App\Exports\CoachingsExport;
use App\Exports\ProficienciesExport;
use App\Exports\CourseTitlesExport;
use App\Exports\SubcategoriesExport;
use App\Exports\DeliveryFormatsExport;
use App\Exports\EventTypesExport;
use App\Exports\TimezonesExport;
use App\Models\User;
use App\Models\Categories;
use App\Models\Certifications;
use App\Models\Languages;
use App\Models\Skills;
use App\Models\Countries;
use App\Models\Types;
use App\Models\Coachings;
use App\Models\Institutions;
use App\Models\Icfs;
use App\Models\Products;
use App\Models\CourseTitles;
use App\Models\DeliveryFormats;
use App\Models\EventTypes;
use App\Models\Timezones;
use Excel;
use Auth;

class ExportController extends Controller
{
    /**
     * For exporting users data
     *
     * @return Excel excel sheet
     */
    public function exportUsers($id, Request $request)
    {
        $query = User::query();
        $offset = 10;
        if($id == 'admin')
        $query->where('role_id', 1);
        elseif($id == 'skillsfindr')
        $query->where('role_id', 2);
        elseif($id == 'skillsmaster')
        $query->where('role_id', 3);
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->email != null && $request->email != '') {
            $query->where('email', 'like', "%$request->email%");
        }
        if ($request->country != null && $request->country != '') {
            $query->whereHas('countryname', function ($query1) {
                $query1->where('name', 'like', "%$request->country%");
            });
        }

        $items = $query->where('id', '!=', \Auth::id())->orderBy('id', 'desc')->get();
        $sorted_items = $items;
        if ($request->name != null && $request->name != '') {
        $sorted_items = $items->filter(function(User $user) use($request){
            return strpos($user->full_name, $request->name) !== false;
        });
    }
        if ($request->mobile != null && $request->mobile != '') {
        $sorted_items = $items->filter(function(User $user) use($request){
            return strpos($user->country_code.' '.$user->mobile, $request->mobile) !== false;
        });
    }
        return Excel::download(new UsersExport($sorted_items), $id.'.xlsx');
    }

    /**
     * For exporting categories data
     *
     * @return Excel excel sheet
     */
    public function exportCategories(Request $request)
    {
        $query = Categories::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->where('parent_id', NULL)->orderBy('id', 'desc')->get();
        return Excel::download(new CategoriesExport($items), 'categories.xlsx');
    }

    /**
     * For exporting subcategories data
     *
     * @return Excel excel sheet
     */
    public function exportSubcategories(Request $request)
    {
        $query = Categories::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->category != null && $request->category != '') {
            $query->whereHas('category', function ($query1) use($request){
                $query1->where('name', 'like', "%$request->category%");
            });
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->where('parent_id', '!=', NULL)->orderBy('id', 'desc')->get();
        return Excel::download(new SubcategoriesExport($items), 'subcategories.xlsx');
    }

    /**
     * For exporting deliveryformats data
     *
     * @return Excel excel sheet
     */
    public function exportDeliveryFormats(Request $request)
    {
        $query = DeliveryFormats::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->type != null && $request->type != '') {
            $query->whereHas('type', function ($query1) use($request){
                $query1->where('name', 'like', "%$request->type%");
            });
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new DeliveryFormatsExport($items), 'deliveryformats.xlsx');
    }

    /**
     * For exporting types data
     *
     * @return Excel excel sheet
     */
    public function exportTypes(Request $request)
    {
        $query = Types::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new TypesExport($items), 'types.xlsx');
    }

    /**
     * For exporting certifications data
     *
     * @return Excel excel sheet
     */
    public function exportCertifications(Request $request)
    {
        $query = Certifications::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new CertificationsExport($items), 'certifications.xlsx');
    }

    /**
     * For exporting languages data
     *
     * @return Excel excel sheet
     */
    public function exportLanguages(Request $request)
    {
        $query = Languages::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new LanguagesExport($items), 'languages.xlsx');
    }

    /**
     * For exporting skills data
     *
     * @return Excel excel sheet
     */
    public function exportSkills(Request $request)
    {
        $query = Skills::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new SkillsExport($items), 'skills.xlsx');
    }

    /**
     * For exporting products data
     *
     * @return Excel excel sheet
     */
    public function exportProducts(Request $request)
    {
        $query = Products::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new ProductsExport($items), 'Products.xlsx');
    }

    /**
     * For exporting countries data
     *
     * @return Excel excel sheet
     */
    public function exportCountries(Request $request)
    {
        $query = Countries::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new CountriesExport($items), 'countries.xlsx');
    }

    public function exportIcfs(Request $request)
    {
        $query = Icfs::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new IcfsExport($items), 'icfs.xlsx');
    }

    public function exportInstitutions(Request $request)
    {
        $query = Institutions::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new InstitutionsExport($items), 'institutions.xlsx');
    }

    public function exportCoachings(Request $request)
    {
        $query = Coachings::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new CoachingsExport($items), 'coachings.xlsx');
    }

    public function exportTimezones(Request $request)
    {
        $query = Timezones::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new TimezonesExport($items), 'timezones.xlsx');
    }

    public function exportProficiencies(Request $request)
    {
        $query = LanguageProficiencies::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new ProficienciesExport($items), 'proficiencies.xlsx');
    }

    public function exportCourseTitles(Request $request)
    {
        $query = CourseTitles::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new CourseTitlesExport($items), 'coursetitles.xlsx');
    }

    public function exportEventTypes(Request $request)
    {
        $query = EventTypes::query();
        $offset = 10;
        if ($request->offset != null && $request->offset != '') {
            $offset = $request->offset;
        }
        if ($request->name != null && $request->name != '') {
            $query->where('name', 'like', "%$request->name%");
        }

        $items = $query->orderBy('id', 'desc')->get();
        return Excel::download(new EventTypesExport($items), 'eventtypes.xlsx');
    }

}
