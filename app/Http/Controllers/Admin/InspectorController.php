<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Observe;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class InspectorController extends Controller
{
    /**
     * View Functions
     */
    public function index()
    {
        return view('dashboard.inspector.index');
    }
    public function data()
    {
        $data = Observe::query()->where('status', 'pending')->latest()->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('dashboard.inspector.action', ['inspector' => $data, 'type' => 'action']);
            })
            ->addColumn('show_profile', function ($data) {
                return view('dashboard.inspector.action', ['inspector' => $data, 'type' => 'show_profile']);
            })
            ->make(true);
    }

    public function filter_accounts(Request $request)
    {
        $request->validate(['status' => 'required|string|in:accept,pending,cancel']);
        $data = Observe::query()->where('status', $request->status)->latest()->get();
        return $data;

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('dashboard.inspector.action', ['inspector' => $data, 'type' => 'action']);
            })
            ->addColumn('show_profile', function ($data) {
                return view('dashboard.inspector.action', ['inspector' => $data, 'type' => 'show_profile']);
            })
            ->make(true);
    }

    public function show($inspector_id)
    {
        $inspector = Observe::findOrFail($inspector_id);
        if (!$inspector) return redirect()->back()->with(["error" => "Inspector not found"]);
        return view('dashboard.inspector.show', compact('inspector'));
    }

    /**************************
     * Accept or reject inspector
     ***************************/
    public function accept($inspector_id)
    {
        $inspector = Observe::findOrFail($inspector_id);
        if (!$inspector) {
            return response()->json(['error' => 'Inspector not found']);
        }
        $inspector->update(['status' => 'accept']);
        return redirect()->back()->with(['success' => 'Data saved successfully!']);
    }
    public function reject($inspector_id)
    {
        $inspector = Observe::findOrFail($inspector_id);
        if (!$inspector) {
            return response()->json(['error' => 'Inspector not found']);
        }
        $inspector->update(['status' => 'cancel']);
        return redirect()->back()->with(['success' => 'Data saved successfully!']);
    }

    public function delete($inspector_id)
    {

        $inspector = Observe::findOrFail($inspector_id);
        if (!$inspector) {
            return response()->json(['error' => 'Inspector not found']);
        }

        try {
            $attachments = [
                $this->personal . '/' . $inspector->img_personal,
                $this->passport . '/' . $inspector->img_passport,
                $this->national_id . '/' . $inspector->img_national,
                $this->certificate . '/' . $inspector->img_certificate,
                $this->certificate_good_conduct . '/' . $inspector->img_certificate_good_conduct
            ];
            foreach ($attachments as $img) {
                if (File::exists($img)) {
                    File::delete($img);
                }
                $inspector->delete();
            }
        } catch (\Exception $ex) {
        }
    }
}
