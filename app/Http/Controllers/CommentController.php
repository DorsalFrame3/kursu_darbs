<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    use AuthorizesRequests;

    // create
    public function store(Request $request, $type, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $modelClass = "App\\Models\\" . ucfirst($type);
        if (!class_exists($modelClass)) {
            abort(404, "Entity type not found.");
        }

        $entity = $modelClass::findOrFail($id);

        $entity->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    // delete
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment); 
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }

}

