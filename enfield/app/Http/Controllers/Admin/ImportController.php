<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use App\Imports\CategoriesImport;
use App\Imports\CertificationsImport;
use App\Imports\LanguagesImport;
use App\Imports\SkillsImport;
use App\Imports\ProductsImport;
use App\Imports\CountriesImport;
use App\Imports\TypesImport;
use App\Imports\InstitutionsImport;
use App\Imports\IcfsImport;
use App\Imports\ProficienciesImport;
use App\Imports\CoachingsImport;
use App\Imports\CourseTitlesImport;
use App\Imports\SubcategoriesImport;
use App\Imports\DeliveryFormatsImport;
use App\Imports\EventTypesImport;
use App\Imports\TimezonesImport;
use App\Models\User;
use App\Models\Categories;
use App\Models\Certifications;
use App\Models\Languages;
use App\Models\Skills;
use App\Models\Countries;
use App\Models\Types;
use Excel;
use Auth;

class ImportController extends Controller
{
    /**
     * For importing users data
     *
     * @return Excel excel sheet
     */
    public function importUsers($id, Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new UsersImport($id), $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing categories data
     *
     * @return Excel excel sheet
     */
    public function importCategories(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new CategoriesImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing subcategories data
     *
     * @return Excel excel sheet
     */
    public function importSubcategories(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new SubcategoriesImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing deliveryformats data
     *
     * @return Excel excel sheet
     */
    public function importDeliveryFormats(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new DeliveryFormatsImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing types data
     *
     * @return Excel excel sheet
     */
    public function importTypes(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new TypesImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing certifications data
     *
     * @return Excel excel sheet
     */
    public function importCertifications(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new CertificationsImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing languages data
     *
     * @return Excel excel sheet
     */
    public function importLanguages(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new LanguagesImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing skills data
     *
     * @return Excel excel sheet
     */
    public function importSkills(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new SkillsImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing skills data
     *
     * @return Excel excel sheet
     */
    public function importProducts(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|max:10240',
        ]);

        Excel::import(new ProductsImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing countries data
     *
     * @return Excel excel sheet
     */
    public function importCountries(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new CountriesImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing Institutions data
     *
     * @return Excel excel sheet
     */
    public function importInstitutions(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new InstitutionsImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing Icfs data
     *
     * @return Excel excel sheet
     */
    public function importIcfs(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new IcfsImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing Coachings data
     *
     * @return Excel excel sheet
     */
    public function importCoachings(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new CoachingsImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing timezones data
     *
     * @return Excel excel sheet
     */
    public function importTimezones(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new TimezonesImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing Proficiencies data
     *
     * @return Excel excel sheet
     */
    public function importProficiencies(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new ProficienciesImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing coursetitles data
     *
     * @return Excel excel sheet
     */
    public function importCourseTitles(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new CourseTitlesImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }

    /**
     * For importing eventtypes data
     *
     * @return Excel excel sheet
     */
    public function importEventTypes(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx|max:10240',
        ]);

        Excel::import(new EventTpesImport, $request->file('file'));
        return response()->json([
            'message' => 'Imported successfully'
        ]);
    }
}
