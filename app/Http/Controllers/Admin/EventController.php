<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Admin\EventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $events = Event::paginate(10);
        return view('admin.events.index', compact('events'));
    }

   /**
 * Show the form for creating a new resource.
 */
public function create(): View
{
    $categories = Category::all();

    return view('admin.events.form', compact('categories'));
}

   /**
 * Store a newly created resource in storage.
 */
public function store(EventRequest $request): RedirectResponse
{
    // Create slug
    $request->merge([
        'slug' => Str::slug($request->name),
    ]);

    // Handle is_popular checkbox
    $request->merge([
        'is_popular' => $request->has('is_popular') ? true : false,
    ]);

    // Upload multiple photos
    if ($request->hasFile('files')) {
        $photos = [];

        foreach ($request->file('files') as $file) {
            $photos[] = $file->store('events', 'public');
        }

        $request->merge([
            'photos' => $photos,
        ]);
    }

    // Create event
    Event::create($request->except('files'));

    // Return to index
    return redirect()->route('admin.events.index')->with('success', 'Event created');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
 
public function edit(Event $event): View
{
    $categories = Category::all();

    return view('admin.events.form', compact('event', 'categories'));
}

   /**
 * Update the specified resource in storage.
 */
public function update(EventRequest $request, string $id): RedirectResponse
{
    // Create slug
    $request->merge([
        'slug' => Str::slug($request->name),
    ]);

    // Handle is_popular checkbox
    $request->merge([
        'is_popular' => $request->has('is_popular') ? true : false,
    ]);

    // Upload multiple photos if exist
    if ($request->hasFile('files')) {
        $photos = [];

        foreach ($request->file('files') as $file) {
            $photos[] = $file->store('events', 'public');
        }

        $request->merge([
            'photos' => $photos,
        ]);
    }

    // Update event
    Event::find($id)->update($request->except('files'));

    // Return to index
    return redirect()->route('admin.events.index')->with('success', 'Event updated');
}

    /**
  
 * Remove the specified resource from storage.
 */
public function destroy(Event $event): RedirectResponse
{
    // Delete event
    $event->delete();

    // Return to index
    return redirect()->route('admin.events.index')->with('success', 'Event deleted');
    
}
}
