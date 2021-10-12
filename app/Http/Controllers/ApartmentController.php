<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentRequest;
use App\Models\Apartment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->isRole('OFFICER')) {
                $apartments = Apartment::whereUserId(Auth::id())->with('rooms')->get();
            } else {
                $apartments = Apartment::with('rooms')->get();
            }
        } else {
            $apartments = Apartment::with('rooms')->get();
        }
        return view('apartments.index', [
            'apartments' => $apartments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Apartment::class);
//        if (Auth::user()->cannot('create', Apartment::class)) {
//            return redirect()->route('apartments.index');
//        }
        return view('apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ApartmentRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(ApartmentRequest $request)
    {
        $this->authorize('create', Apartment::class);
        $validator = Validator::make($request->all(), [
            'name' => [
                Rule::unique('apartments'),
            ],
        ])->validate();

        $apartment = new Apartment();
        $apartment->name = $request->input('name');
        $apartment->floors = $request->input('floors');
        $apartment->save();
        return redirect()->route('apartments.index');
    }

    /**
     * Show form to create new room in this apartment
     *
     * @param $apartment_id
     */
    public function createRoom($apartment_id) {
        $apartment = Apartment::findOrFail($apartment_id);
        $this->authorize('update', $apartment);
        $room_types = Room::$room_types;
        array_push($room_types, 'EXTRA');
        array_push($room_types, 'EXTRA-2');
        return view('apartments.create-room', [
            'apartment' => $apartment,
            'room_types' => $room_types
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::with('rooms')->findOrFail($id);
        $this->authorize('view', $apartment);
        return view('apartments.show', [
            'apartment' => $apartment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apartment = Apartment::findOrFail($id);
        $this->authorize('update', $apartment);
        return view('apartments.edit', [
            'apartment' => $apartment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ApartmentRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ApartmentRequest $request, $id)
    {
        $apartment = Apartment::findOrFail($id);
        $this->authorize('update', $apartment);
        $validator = Validator::make($request->all(), [
            'name' => [
                Rule::unique('apartments')->ignore($id),
            ],
        ])->validate();

        $apartment->name = $request->input('name');
        $apartment->floors = $request->input('floors');
        $apartment->save();
        return redirect()->route('apartments.show', ['apartment' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $apartment = Apartment::findOrFail($id);
        $this->authorize('delete', $apartment);
        if ($apartment->name === $request->input('name')) {
            $apartment->delete();
            return redirect()->route('apartments.index');
        }
        return redirect()->back();

    }
}
