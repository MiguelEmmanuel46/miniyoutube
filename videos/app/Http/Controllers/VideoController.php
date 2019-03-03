<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BD;
use Illuminate\Support\Facades\Strorage;
use Symfony\Component\HttpFoundation\Response;

use App\Video;
use App\Comment;


class VideoController extends Controller
{
    public function createVideo()
    {
    	return view('video.createVideo');
    }

    public function saveVideo(Request $request)
    {
    	//validar formulario
    	$validatedData = $this->validate($request, [
    		'title' => 'required|min:5',
    		'description' => 'required',
    		'video' => 'mimes:mp4'
    	]);

    	$video = new Video();
    	$user = \Auth::user();
    	$video->user_id = $user->id;
    	$video->title = $request->input('title');
    	$video->description = $request->input('description');

    	//subir miniatura
    	$image = $request->file('image');
    	if ($image) {
    		$image_path = time().$image->getClientOriginalName();
    		\Storage::disk('img')->put($image_path, \File::get($image));
    		$video->image = $image_path;
    	}

    	//subir video
    	$video_file = $request->file('video');
    	if ($video_file) {
    		$video_path = time().$video_file->getClientOriginalName();
    		\Storage::disk('videos')->put($video_path, \File::get($video_file));
    		$video->video_path = $video_path;
    	}

    	$video->save();
    	return redirect()->route('home')->with(array(
    		'message' => 'El video se subio'
    	));
    }

    public function getImage($filename)
    {
    	$file = \Storage::disk('img')->get($filename);
    	return new Response($file, 200);
    }
}
