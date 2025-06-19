<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\JobType;
use App\Models\Post;
use App\Models\Seniority;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function getPostCreateData()
    {
        $industries = \App\Models\Industry::all();
        $jobTypes = \App\Models\JobType::all();
        $seniorities = \App\Models\Seniority::all();

        return response()->json([
            'industries' => $industries,
            'jobTypes' => $jobTypes,
            'seniorities' => $seniorities,
        ]);
    }

    public function getPosts()
    {
        $posts = Post::with(['jobType', 'industry', 'seniority'])->get();

        return response()->json([
            'message' => 'Posts retrieved successfully',
            'posts' => $posts
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user()->getRoleNames();
        if(!Auth::user()->can('create posts')) return response()->json(['message' => 'Unauthorized'], 403);
        
        $params = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'industry_id' => 'required|max:255',
            'job_type_id' => 'required|max:255',
            'seniority_id' => 'required|max:255',
            'about' => 'required|string',
            'responsibilities' => 'required|string',
            'requirements' => 'required|string',
        ]);

        $params['user_id'] = Auth::id();
        
        if($request->hasFile('image'))
        {
            $params['image'] = $request->file('image')->store('images', 'public');
        }

        if($request->hasFile('logo'))
        {
            $params['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $post = Post::create($params);

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with(['jobType', 'industry', 'seniority'])->find($id);

        if($post)
        {
            return response()->json([
                'message' => 'Post found',
                'post' => $post
            ], 200);
        }
        return response()->json(['message' => 'Post not found'], 404);
    }

    public function getIndustries(): JsonResponse
    {
        $industries = Industry::all();

        if($industries)
        {
            return response()->json([
                'industries' => $industries,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'Industries not found',
            ], 404);
        }
    }

    public function getPostsByIndustry(int $industryId): JsonResponse
    {
        $posts = Post::with(['jobType', 'industry', 'seniority'])
            ->whereHas('industry', function($query) use ($industryId) {
                $query->where('id', $industryId);
            })->get();

        if($posts->isEmpty())
        {
            return response()->json(['message' => 'No posts found for this industry'], 404);
        }

        return response()->json([
            'message' => 'Posts retrieved successfully',
            'posts' => $posts
        ], 200);
    }

    public function getFilterData(): JsonResponse
    {
        $jobTypes = JobType::all();
        $seniorities = Seniority::all();

        return response()->json([
            'jobTypes' => $jobTypes,
            'seniorities' => $seniorities,
        ]);
    }
}
