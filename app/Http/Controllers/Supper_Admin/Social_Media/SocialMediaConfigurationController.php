<?php

namespace App\Http\Controllers\Supper_Admin\Social_Media;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supper_Admin\Social_Media\SocialMediaConfiguration;
use Illuminate\Validation\ValidationException;

class SocialMediaConfigurationController extends Controller
{

    public function index()
    {
        $facebookConfigs = SocialMediaConfiguration::get();
        return view('supper_admin.pages.social_media.fb_media_configuration', compact('facebookConfigs'));
    }

    public function ActiveIndex(Request $request)
    {
        $socialMediaConfigs = SocialMediaConfiguration::where('status', 'Active')->get();
        return response()->json($socialMediaConfigs);
    }

    public function create()
    {
        // return view('supper_admin.pages.social_media.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'platform' => 'required|string|max:255',
                'page_name' => 'required|string|max:255',
                'page_id' => 'required|string|max:255',
                'app_id' => 'required|string|max:255',
                'app_secret' => 'required|string|max:255',
                'access_token' => 'required|string|max:255',
                'status' => 'in:Active,Inactive'
            ]);

            $user_id = Auth::id();

            $data = [
                'platform' => $request->input('platform'),
                'page_name' => $request->input('page_name'),
                'page_id' => $request->input('page_id'),
                'app_id' => $request->input('app_id'),
                'app_secret' => $request->input('app_secret'),
                'access_token' => $request->input('access_token'),
                'status' => $request->input('status') === 'Active' ? 'Active' : 'Inactive',
                'user_id' => $user_id,
            ];

            SocialMediaConfiguration::create($data);

            return response()->json(['status' => 'success', 'message' => 'Social media configuration added successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }

    public function edit($id)
    {
        $socialMediaConfig = SocialMediaConfiguration::findOrFail($id);
        return response()->json($socialMediaConfig);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'platform' => 'required|string|max:255',
                'page_name' => 'required|string|max:255',
                'page_id' => 'required|string|max:255',
                'app_id' => 'required|string|max:255',
                'app_secret' => 'required|string|max:255',
                'access_token' => 'required|string|max:255',
                'status' => 'in:Active,Inactive'
            ]);

            $socialMediaConfig = SocialMediaConfiguration::findOrFail($id);
            $socialMediaConfig->platform = $request->input('platform');
            $socialMediaConfig->page_name = $request->input('page_name');
            $socialMediaConfig->page_id = $request->input('page_id');
            $socialMediaConfig->app_id = $request->input('app_id');
            $socialMediaConfig->app_secret = $request->input('app_secret');
            $socialMediaConfig->access_token = $request->input('access_token');
            $socialMediaConfig->status = $request->input('status') === 'Active' ? 'Active' : 'Inactive';
            $socialMediaConfig->user_id = Auth::id();

            $socialMediaConfig->save();

            return response()->json(['status' => 'success', 'message' => 'Social media configuration updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }

    public function destroy($id)
    {
        $socialMediaConfig = SocialMediaConfiguration::findOrFail($id);
        $socialMediaConfig->delete();

        return response()->json(['status' => 'success', 'message' => 'Social media configuration deleted successfully']);
    }
}
