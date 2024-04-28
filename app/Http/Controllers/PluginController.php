<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PluginController extends Controller
{
    public function addPlugin()
    {
        //GET ALL THE PLUGINS IN THE PLUGIN FOLDER located in the pulic folder
        $plugins = scandir(base_path('plugins'));
        //GET ALL THE PLUGINS IN THE PLUGIN FOLDER located in the pulic folder
        $plugins = array_diff($plugins, array('.', '..'));
        return view('app.plugins.addplugin', ['plugins' => $plugins]);
    }

    public function uploadPlugin(Request $request)
    {

        $file = $request->file('plugin');
        //Check if it is empty
        if (empty($file)) {
            return redirect()->back()->with('error', 'Please select a file');
        } else {
            // Check if the file is a zip file
            if ($file->getClientOriginalExtension() != 'zip') {
                return redirect()->back()->with('error', 'The file must be a zip file');
            } else {
                //CHECK UNZIP PERMISSION IS ENABLED
                if (!extension_loaded('zip')) {
                    return redirect()->back()->with('error', 'The zip extension is not enabled');
                } else {
                    // Extract the zip file
                    $extractPath = base_path('plugins'); // Define the extraction path
                    $zip = new \ZipArchive;
                    $res = $zip->open($file);
                    if ($res === TRUE) {
                        // Check if the plugin already exists
                        $pluginName = explode('.', $file->getClientOriginalName())[0];
                        if (file_exists($extractPath . '/' . $pluginName)) {
                            return redirect()->back()->with('error', 'The plugin already exists');
                        } else {
                            // Extract the zip file
                            $zip->extractTo($extractPath);
                            $zip->close();
                            return redirect()->back()->with('success', 'Plugin uploaded successfully');
                        }
                    } else {
                        return redirect()->back()->with('error', 'Error uploading the plugin');
                    }
                }
            }
        }
    }



    public function installPlugin($plugin)
    {
        //CHECK IF THE PLUGIN EXISTS
        if (file_exists(base_path('plugins/' . $plugin))) {
            //Change intstall value to true in the plugin.json file
            $pluginJson = json_decode(file_get_contents(base_path('plugins/' . $plugin . '/plugin_info.json')), true);
            //check if the plugin is already installed
            if ($pluginJson['installed'] == true) {
                return redirect()->back()->with('error', 'The plugin is already installed');
            } else {
                $pluginJson['installed'] = true;
                file_put_contents(base_path('plugins/' . $plugin . '/plugin_info.json'), json_encode($pluginJson));
                return redirect()->back()->with('success', 'Plugin installed successfully');
            }
        } else {
            return redirect()->back()->with('error', 'The plugin does not exist');
        }
    }


    public function uninstallPlugin($plugin)
    {
        //CHECK IF THE PLUGIN EXISTS
        if (file_exists(base_path('plugins/' . $plugin))) {
            //Change intstall value to false in the plugin.json file
            $pluginJson = json_decode(file_get_contents(base_path('plugins/' . $plugin . '/plugin_info.json')), true);
            //check if the plugin is already uninstalled
            if ($pluginJson['installed'] == false) {
                return redirect()->back()->with('error', 'The plugin is already uninstalled');
            } else {
                $pluginJson['installed'] = false;
                file_put_contents(base_path('plugins/' . $plugin . '/plugin_info.json'), json_encode($pluginJson));
                return redirect()->back()->with('success', 'Plugin uninstalled successfully');
            }
        } else {
            return redirect()->back()->with('error', 'The plugin does not exist');
        }
    }

    public function deleteDir($dirPath)
    {
        if (!is_dir($dirPath)) {
            return false;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }


    public function removePlugin($plugin)
    {
        //CHECK IF THE PLUGIN EXISTS
        if (file_exists(base_path('plugins/' . $plugin))) {
            //Delete the plugin folder
            $pluginJson = json_decode(file_get_contents(base_path('plugins/' . $plugin . '/plugin_info.json')), true);
            if ($pluginJson['installed'] == true) {
                return redirect()->back()->with('error', 'The plugin is installed. Please uninstall it first');
            } else {
                //Delete the plugin folder
                $this->deleteDir(base_path('plugins/' . $plugin));
                return redirect()->back()->with('success', 'Plugin removed successfully');
            }
        } else {
            return redirect()->back()->with('error', 'The plugin does not exist');
        }
    }
}
