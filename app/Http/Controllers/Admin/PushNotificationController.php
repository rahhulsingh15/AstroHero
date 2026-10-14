<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PushNotification;
use App\Models\Subscriber;
use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Throwable;

class PushNotificationController extends Controller
{
    public function index()
    {
        $notifications = PushNotification::latest()->paginate(20);
        $subscriberCount = Subscriber::whereNotNull('fcm_token')->count();

        return view('admin.push_notification.index', compact('notifications', 'subscriberCount'));
    }

    public function create()
    {
        $subscriberCount = Subscriber::whereNotNull('fcm_token')->count();

        return view('admin.push_notification.create', compact('subscriberCount'));
    }

    public function store(Request $request, FirebaseService $firebase)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'body'  => 'required|string|max:250',
            'link'  => 'nullable|url|max:255',
        ]);

        $tokens = Subscriber::whereNotNull('fcm_token')->pluck('fcm_token')->all();

        if (empty($tokens)) {
            return back()->withInput()->withErrors(['title' => 'Abhi koi subscriber nahi hai jise notification bheja ja sake.']);
        }

        try {
            $result = $firebase->sendToTokens($tokens, $validated['title'], $validated['body'], $validated['link'] ?? null);
        } catch (Throwable $e) {
            report($e);
            return back()->withInput()->withErrors(['title' => 'Firebase error: ' . $e->getMessage()]);
        }

        // Jo tokens ab valid nahi hain unhe hata do
        if ($result['invalid']) {
            Subscriber::whereIn('fcm_token', $result['invalid'])->delete();
        }

        PushNotification::create($validated + [
            'sent_count'   => $result['sent'],
            'failed_count' => $result['failed'],
        ]);

        return redirect()->route('admin.push_notification.index')
            ->with('success', "Notification sent to {$result['sent']} subscriber(s). Failed: {$result['failed']}.");
    }

    public function delete($id)
    {
        PushNotification::findOrFail($id)->delete();

        return redirect()->route('admin.push_notification.index')->with('success', 'Record deleted successfully.');
    }
}
