<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Http\Client\RequestException;


class UpdateController extends Controller
{

    public function showVersion()
    {
        $currentVersion = config('app.version');
        $latestRelease = Http::get('https://api.github.com/repos/UMESKIA-SOFTWARES/LaraAdminify/releases/latest')->json();
        $latestVersion = $latestRelease['tag_name'];
        return view('app.settings.version', compact('currentVersion', 'latestVersion'));
    }

    public function updateApp()
    {
        try {
            $latestRelease = Http::timeout(60)->get('https://api.github.com/repos/UMESKIA-SOFTWARES/LaraAdminify/releases/latest')->json();
            $latestVersion = $latestRelease['tag_name'];
            $latestZip = $latestRelease['zipball_url'];
            $currentVersion = config('app.version');

            // Check if the app is already up to date
            if ($currentVersion == $latestVersion) {
                return redirect()->back()->with('info', 'LaraAdminify is already up to date');
            } else {
                $latestZipContents = Http::timeout(60)->get($latestZip)->body();
                Storage::disk('local')->put('latest.zip', $latestZipContents);
                $zip = new ZipArchive;
                $res = $zip->open(storage_path('app/latest.zip'));
                if ($res === TRUE) {
                    $zip->extractTo(base_path());
                    $zip->close();
                    //UPDATE THE VERSION IN THE CONFIG FILE
                    $config = file_get_contents(base_path('config/app.php'));
                    $config = str_replace($currentVersion, $latestVersion, $config);
                    file_put_contents(base_path('config/app.php'), $config);
                    return redirect()->back()->with('success', 'LaraAdminify updated successfully');
                } else {
                    return redirect()->back()->with('error', 'Failed to update LaraAdminify');
                }
            }
        } catch (RequestException $e) {
            return redirect()->back()->with('error', 'Failed to update LaraAdminify' . $e->getMessage());
        }
    }

}
