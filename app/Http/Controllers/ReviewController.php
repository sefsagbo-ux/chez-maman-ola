<?php
namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::updateOrCreate(
            ['product_id' => $product_id, 'user_id' => auth()->id()],
            ['rating' => $request->rating, 'comment' => $request->comment]
        );

        return back()->with('success', 'Merci pour ton avis ! ⭐');
    }
}