<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookingIndex()
    {
        // Get all available menus grouped by category
        $categories = Category::with(['menus' => function($query) {
            $query->where('is_available', true);
        }])->get();

        // Get signature menus
        $signatureMenus = Menu::where('is_signature', true)
            ->where('is_available', true)
            ->get();

        return view('booking', compact('categories', 'signatureMenus'));
    }

    public function store(Request $request)
    {
        // Validate and process booking
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email',
            'visit_date' => 'required|date|after_or_equal:today',
            'visit_time' => 'required|string',
            'tickets' => 'required|array',
            'tickets.*.type' => 'required|string',
            'tickets.*.quantity' => 'required|integer|min:0',
            'menu_items' => 'nullable|array',
            'menu_items.*.id' => 'required|integer|exists:menus,id',
            'menu_items.*.quantity' => 'required|integer|min:0',
            'notes' => 'nullable|string|max:500',
            'payment_method' => 'required|string|in:tempat,transfer,qris',
            'agree_terms' => 'required|accepted',
        ]);

        // Save booking to database
        $bookingCode = 'BK' . strtoupper(uniqid());
        Booking::create([
            'booking_code' => $bookingCode,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'],
            'visit_date' => $validated['visit_date'],
            'visit_time' => $validated['visit_time'],
            'tickets' => json_encode($validated['tickets']),
            'menu_items' => $validated['menu_items'] ? json_encode($validated['menu_items']) : null,
            'notes' => $validated['notes'],
            'payment_method' => $validated['payment_method'],
            'agree_terms' => $validated['agree_terms'],
        ]);

        return response()->json([
            'success' => true,
            'booking_code' => $bookingCode,
            'message' => 'Pemesanan berhasil!'
        ]);
    }

    public function index()
    {
        $categories = \App\Models\Category::all();
        $menus = \App\Models\Menu::where('is_available', true)->get();

        return view('booking', compact('categories', 'menus')); // Sesuaikan dengan nama file booking.blade.php
    }

    // Admin CRUD methods
    public function adminIndex()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email',
            'visit_date' => 'required|date',
            'visit_time' => 'required|string',
            'tickets' => 'required|json',
            'menu_items' => 'nullable|json',
            'notes' => 'nullable|string|max:500',
            'payment_method' => 'required|string|in:tempat,transfer,qris',
            'agree_terms' => 'required|boolean',
        ]);

        // Decode JSON fields
        $tickets = json_decode($validated['tickets'], true);
        $menuItems = $validated['menu_items'] ? json_decode($validated['menu_items'], true) : null;

        // Additional validation for decoded arrays
        if (!is_array($tickets) || empty($tickets)) {
            return back()->withErrors(['tickets' => 'Tickets must be a valid JSON array with at least one item.']);
        }

        foreach ($tickets as $ticket) {
            if (!isset($ticket['type']) || !isset($ticket['quantity']) || !is_numeric($ticket['quantity']) || $ticket['quantity'] < 0) {
                return back()->withErrors(['tickets' => 'Each ticket must have valid type and quantity.']);
            }
        }

        if ($menuItems !== null) {
            if (!is_array($menuItems)) {
                return back()->withErrors(['menu_items' => 'Menu items must be a valid JSON array.']);
            }
            foreach ($menuItems as $item) {
                if (!isset($item['id']) || !isset($item['quantity']) || !is_numeric($item['quantity']) || $item['quantity'] < 0) {
                    return back()->withErrors(['menu_items' => 'Each menu item must have valid id and quantity.']);
                }
            }
        }

        $booking->update([
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'],
            'visit_date' => $validated['visit_date'],
            'visit_time' => $validated['visit_time'],
            'tickets' => $tickets,
            'menu_items' => $menuItems,
            'notes' => $validated['notes'],
            'payment_method' => $validated['payment_method'],
            'agree_terms' => $validated['agree_terms'],
        ]);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully');
    }
}
