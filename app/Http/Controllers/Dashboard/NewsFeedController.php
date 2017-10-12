<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\NewsFeedCreateRequest;
use App\Http\Requests\Dashboard\NewsFeedUpdateRequest;
use App\Models\NewsFeed;

class NewsFeedController extends Controller
{
    protected $view = 'dashboard.news.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 20;
        $data['resources'] = NewsFeed::paginate($limit);
        $data['counter_offset'] = ($request->get('page',1) * $limit) - $limit;
        return view($this->view.'index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->view.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsFeedCreateRequest $request)
    {
        if (NewsFeed::create($request->all())) {
            return redirect()->back()->with('success' , 'Added successfully.');
        }
        return redirect()->back()->withErrors(['error' => 'Something went wrong please try again!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(NewsFeed $news)
    {
        $data['resource'] = $news;
        return view($this->view.'show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsFeed $news)
    {
        $data['resource'] = $news;
        return view($this->view.'edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsFeedUpdateRequest $request, NewsFeed $news)
    {
        if ($news->update($request->all())) {
            return redirect()->route('dashboard.news.index')->with('success' , 'Updated successfully.');
        }
        return redirect()->back()->withErrors(['error' => 'Something went wrong please try again!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsFeed $news)
    {
        if ($news->cover_picture && file_exists(public_path($news->upload_distination.$news->cover_picture))) {
            unlink(public_path($news->upload_distination.$news->cover_picture));
        }
        $news->delete();
        return redirect()->back()->with('success' , 'Deleted successfully.');
    }
}
