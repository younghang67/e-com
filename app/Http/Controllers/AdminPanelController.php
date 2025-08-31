<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function upload(Request $request)
    {
        try {
            // Validate the file
            $request->validate([
                'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Get the uploaded file
            $uploadedFile = $request->file('upload');
            $fileName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $uploadedFile->getClientOriginalExtension();
            $newFileName = $fileName . '_' . time() . '.' . $extension;

            // Get original image dimensions
            list($originalWidth, $originalHeight) = getimagesize($uploadedFile);

            // Set desired dimensions
            $newWidth = 700;
            $newHeight = 300;

            // Create a blank image with new dimensions
            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

            // Load the original image based on its type
            switch (strtolower($extension)) {
                case 'jpeg':
                case 'jpg':
                    $originalImage = imagecreatefromjpeg($uploadedFile);
                    break;
                case 'png':
                    $originalImage = imagecreatefrompng($uploadedFile);
                    // Preserve PNG transparency
                    imagealphablending($resizedImage, false);
                    imagesavealpha($resizedImage, true);
                    break;
                case 'gif':
                    $originalImage = imagecreatefromgif($uploadedFile);
                    break;
                default:
                    throw new \Exception('Unsupported image format.');
            }

            // Resize the original image into the blank image
            imagecopyresampled(
                $resizedImage,
                $originalImage,
                0,
                0,
                0,
                0,
                $newWidth,
                $newHeight,
                $originalWidth,
                $originalHeight
            );

            // Save the resized image
            $path = 'uploads/' . $newFileName;
            $publicPath = storage_path('app/public/' . $path);

            switch (strtolower($extension)) {
                case 'jpeg':
                case 'jpg':
                    imagejpeg($resizedImage, $publicPath, 100); // Save as JPEG with max quality
                    break;
                case 'png':
                    imagepng($resizedImage, $publicPath); // Save as PNG
                    break;
                case 'gif':
                    imagegif($resizedImage, $publicPath); // Save as GIF
                    break;
            }

            // Free memory
            imagedestroy($resizedImage);
            imagedestroy($originalImage);

            // Generate public URL
            $url = asset('storage/' . $path);

            // Return JSON response for CKEditor
            return response()->json([
                'uploaded' => 1,
                'fileName' => $newFileName,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => $e->getMessage(),
                ],
            ]);
        }
    }

}
