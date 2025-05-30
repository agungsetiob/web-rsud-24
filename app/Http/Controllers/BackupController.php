<?php

namespace App\Http\Controllers;

use Artisan;
use Exception;
use Log;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller{
    public function index()
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks'));
        $files = $disk->files('/public/RSUD/');
        $backups = [];
        foreach ($files as $k => $f) {
           if (substr($f, -4) == '.zip' && $disk->exists($f)) {
               $backups[] = [
               'file_path' => $f,
               'file_name' => str_replace(config('laravel-backup.backup.name') . 'public/RSUD/', '', $f),
               'file_size' => $disk->size($f),
               'last_modified' => $disk->lastModified($f),
                ];
           }
        }
        $backups = array_reverse($backups);
        return view("admin.backups")->with(compact('backups'));
    }

    public static function humanFileSize($size,$unit="") {
          if( (!$unit && $size >= 1<<30) || $unit == "GB")
               return number_format($size/(1<<30),2)."GB";
          if( (!$unit && $size >= 1<<20) || $unit == "MB")
               return number_format($size/(1<<20),2)."MB";
          if( (!$unit && $size >= 1<<10) || $unit == "KB")
               return number_format($size/(1<<10),2)."KB";
          return number_format($size)." bytes";
    }

    public function create()
    {
          try {
              Artisan::call('backup:run --only-db');
               $output = Artisan::output();
               Log::info("Backpack\BackupManager -- new backup started \r\n" . $output);
               return redirect()->intended('backup')->with(['success' => $output]);
          } catch (Exception $e) {
               session()->flash('error', $e->getMessage());
               return redirect()->back();
          }
    }

    public function download($file_name)
     {
     $file = config('laravel-backup.backup.name') . 'public/RSUD/' . $file_name;
     $disk = Storage::disk(config('laravel-backup.backup.destination.disks'));

     if ($disk->exists($file)) {
          $stream = $disk->readStream($file);

          return response()->stream(function () use ($stream) {
               fpassthru($stream);
          }, 200, [
               "Content-Type" => $disk->mimeType($file),
               "Content-Length" => $disk->size($file),
               "Content-Disposition" => "attachment; filename=\"" . basename($file) . "\"",
          ]);
     } else {
          abort(404, "Backup file doesn't exist.");
     }
     }

     public function delete($file_name){
          $disk = Storage::disk(config('laravel-backup.backup.destination.disks'));
          if ($disk->exists(config('laravel-backup.backup.name') . 'public/RSUD/' . $file_name)) {
               $disk->delete(config('laravel-backup.backup.name') . 'public/RSUD/' . $file_name);
               session()->flash('delete', 'Successfully deleted backup!');
               return redirect()->back();
          } else {
               abort(404, "Backup file doesn't exist.");
          }
     }
}