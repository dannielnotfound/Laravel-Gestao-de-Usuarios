<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCommentsRequest;
use Illuminate\Http\Request;
use App\Models\{
    Comment,
    User
};

use function PHPUnit\Framework\returnSelf;

class CommentController extends Controller
{
    protected $model;
    protected $user;
    
    public function __construct(Comment $comment, User $user)
    {
        $this->model =  $comment;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $userId)
    {   
        if(!$user =  $this->user->find($userId)){
            return redirect()->back();
        }
        // if($request->search){
        //     $comments = $user->comments()->getComments( search: $request->search ?? '');
        //     return view('users.comments.index', compact('user','comments'));
        // }
        $comments = $user->comments()->where('body', 'LIKE', "%{$request->search}%")->get();
        return view('users.comments.index', compact('user','comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($userId)
    {
        if(!$user =  $this->user->find($userId)){
            return redirect()->back();
        }
        return view('users.comments.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCommentsRequest $request, $id)
    {
        if(!$user =  $this->user->find($id)){
            return redirect()->back();
        }
        $user->comments()->create([
            'body' => $request->body,
            'visible' => isset($request->visible),
        ]);
        return redirect()->route('comments.index', $user->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($userId, $id)
    {
        if (!$comment = $this->model->find($id)) {
            return redirect()->back();
        }

        $user = $comment->user;

        return view('users.comments.edit', compact('user', 'comment'));
    }

    public function update(StoreUpdateCommentsRequest $request, $id)
    {
        if (!$comment = $this->model->find($id)) {
            return redirect()->back();
        }

        $comment->update([
            'body' => $request->body,
            'visible' => isset($request->visible)
        ]);

        return redirect()->route('comments.index', $comment->user_id);
    }

    public function show($userId, $id)
    {   
        if(!$user =  $this->user->find($userId)){
            return redirect()->back();
        }
        $commentId = $id;
        return view('users.comments.show', compact('user', 'commentId'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user, $id)
    {
        if(!$comment = $this->model->find($id))
            return redirect()->route('comments.index', $user);
        $this->model->destroy($id);
            return redirect()->route('comments.index', $user);
    }

    
}
