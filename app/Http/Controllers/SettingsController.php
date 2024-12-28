<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Setting;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $Setting = Setting::orderBy('id', 'desc')->first();

        return view('admin.settings.add', compact('Setting'));
    }


    public function settingsstore(Request $request)
    {
        //dd($request->all());

        if (isset($request->settings_id) && !empty($request->settings_id)) {

            $Setting = Setting::find($request->settings_id);
            $Setting->adminPanelTitle = $request->adminPanelTitle;
            $Setting->adminPanelFooter = $request->adminPanelFooter;
            $Setting->customerAppColor = $request->customerAppColor;
            $Setting->driverAppColor = $request->driverAppColor;
            $Setting->adminPanelColor = $request->adminPanelColor;
            $Setting->driverRadius = $request->driverRadius;
            $Setting->googleMapApiKey = $request->googleMapApiKey;
            $Setting->Duration_For_Driver = $request->Duration_For_Driver;
            $Setting->Otp_Feature = $request->Otp_Feature;
            $Setting->Distance = $request->Distance;
            $Setting->Minimum_wallet_amountRide = $request->Minimum_wallet_amountRide;
            $Setting->Minimum_wallet_amountwithdrawal = $request->Minimum_wallet_amountwithdrawal;
            $Setting->referralAmount = $request->referralAmount;
            $Setting->contactEmail = $request->contactEmail;
            $Setting->contactPhone = $request->contactPhone;
            $Setting->contactAddress = $request->contactAddress;
            $Setting->appVersion = $request->appVersion;
            $Setting->webVersion = $request->webVersion;
            $Setting->aboutPage = $request->aboutPage;
            $Setting->helpPage = $request->helpPage;
            $Setting->termsPage = $request->termsPage;
            $Setting->privacyPolicyPage = $request->privacyPolicyPage;
            $Setting->howItWorksPage = $request->howItWorksPage;
            $Setting->outstationFaqsPage = $request->outstationFaqsPage;
            $Setting->partnerCarePage = $request->partnerCarePage;
            $Setting->covid19Page = $request->covid19Page;

            $Setting->rideInclusions = json_encode($request->rideInclusions);

            $Setting->rulesRestrictions = json_encode($request->rulesRestrictions);

            $Setting->termsConditions = json_encode($request->termsConditions);

            if ($request->hasFile('adminPanelLogo')) {
                $imageName = time() . '.' . $request->adminPanelLogo->extension();
                $request->adminPanelLogo->move(public_path('images'), $imageName);
                $Setting->adminPanelLogo = $imageName;
            }

            if ($request->hasFile('toggleMenuLogo')) {
                $imageName = time() . '.' . $request->toggleMenuLogo->extension();
                $request->toggleMenuLogo->move(public_path('images'), $imageName);
                $Setting->toggleMenuLogo = $imageName;
            }

            if ($Setting->save()) {

                return redirect()->route('settings.index')->with('success', 'Settings Save successfully.');
            } else {
                die('A Error Plese Check');
            }
        }
    }

    public function rideInclusions_remove($value, $id)
    {
        $settingsdata = Setting::find($id);
        if ($settingsdata) {
            $rideInclusion = json_decode($settingsdata->rideInclusions, true);

            if (is_array($rideInclusion)) {
                $searchkey = array_search($value, $rideInclusion, true);

                unset($rideInclusion[$searchkey]);

                $updatedata = array_values($rideInclusion);

                $settingsdata->rideInclusions = json_encode($updatedata);
                $settingsdata->save();
                return redirect()->back()->with('success', 'Remove SuccessFully.');
            } else {
                return redirect()->back()->with('error', 'Inclusion not found.');
            }
        } else {
            return redirect()->back()->with('error', 'Setting not found or could not remove inclusion.');
        }
    }

    public function rulesRestrictions_remove($value, $id)
    {
        $settingsdata = Setting::find($id);
        if ($settingsdata) {
            $rideInclusion = json_decode($settingsdata->rulesRestrictions, true);

            if (is_array($rideInclusion)) {
                $searchkey = array_search($value, $rideInclusion, true);

                unset($rideInclusion[$searchkey]);

                $updatedata = array_values($rideInclusion);

                $settingsdata->rulesRestrictions = json_encode($updatedata);
                $settingsdata->save();
                return redirect()->back()->with('success', 'Remove SuccessFully.');
            } else {
                return redirect()->back()->with('error', 'Inclusion not found.');
            }
        } else {
            return redirect()->back()->with('error', 'Setting not found or could not remove inclusion.');
        }
    }
    public function termsConditions_remove_remove($value, $id)
    {
        $settingsdata = Setting::find($id);
        if ($settingsdata) {
            $rideInclusion = json_decode($settingsdata->termsConditions, true);

            if (is_array($rideInclusion)) {
                $searchkey = array_search($value, $rideInclusion, true);

                unset($rideInclusion[$searchkey]);

                $updatedata = array_values($rideInclusion);

                $settingsdata->termsConditions = json_encode($updatedata);
                $settingsdata->save();
                return redirect()->back()->with('success', 'Remove SuccessFully.');
            } else {
                return redirect()->back()->with('error', 'Inclusion not found.');
            }
        } else {
            return redirect()->back()->with('error', 'Setting not found or could not remove inclusion.');
        }
    }
}
