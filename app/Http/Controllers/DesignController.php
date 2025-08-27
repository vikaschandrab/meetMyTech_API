<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DesignService;

class DesignController extends Controller
{
    /**
     * Get current design information
     */
    public function info()
    {
        return response()->json(DesignService::getDesignInfo());
    }

    /**
     * Reset the session design
     */
    public function reset()
    {
        $newDesign = DesignService::resetSessionDesign();
        return redirect()->back()->with('success', "Design reset! Now using Design {$newDesign}");
    }

    /**
     * Set a specific design
     */
    public function set($design)
    {
        if (DesignService::setSessionDesign((int)$design)) {
            return redirect()->back()->with('success', "Design set to Design {$design}");
        }
        return redirect()->back()->with('error', 'Invalid design number. Use 1, 2, or 3.');
    }

    /**
     * Design testing page
     */
    public function test()
    {
        $designInfo = DesignService::getDesignInfo();

        return view('admin.design-test', compact('designInfo'));
    }
}
