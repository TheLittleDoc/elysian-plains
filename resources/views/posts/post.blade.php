<?php use Carbon\Carbon; ?>


<x-layout>
    <div class="max-w-4xl mx-auto">
            <div class="card bg-base-100 shadow mt-8">
                <div class="card-body">
                    <div>
                        <h1 class="text-3xl font-bold">{{$post['title']}}</h1>
                        @auth
                            @if(Auth::user()->id === $post['user_id'])
                                <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error mt-2" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>

                                </form>
                                <form action="{{ route('posts.edit', $post['id']) }}" method="GET" class="inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning mt-2">Edit</button>
                                </form>
                            @endif
                        @endauth
                        @if (@isset ($post['created_at']))
                            @php
                                $date = Carbon::parse($post['created_at']);
                                $formattedDate = $date->format('l, F j, Y');
                            @endphp
                            <p class="text-base-content/60 mt-2">{{$formattedDate}}</p>
                        @endif
                        @php
                            $json_content = json_decode($post['content'], true);
                        @endphp
                        @foreach($json_content as $section)
                            @switch ($section['type'] )
                                @case('paragraph')
                                    <p class="mt-4">{{$section['value']}}</p>
                                    @break
                                @case('image')
                                    <img src="{{$section['url']}}" alt="{{$section['alt']}}" class="mt-4"/>
                                    @break
                                @case('heading')
                                    @switch($section['level'])
                                        @case(1)
                                            <h1 class="text-2xl font-bold mt-4">{{$section['value']}}</h1>
                                            @break
                                        @case(2)
                                            <h2 class="text-xl font-semibold mt-4">{{$section['value']}}</h2>
                                            @break
                                        @case(3)
                                            <h3 class="text-lg font-medium mt-4">{{$section['value']}}</h3>
                                            @break
                                        @default
                                            <p class="mt-4">Unknown heading level: {{$section['level']}}</p>
                                    @endswitch
                                    @break
                                @case('list')
                                    <ul class="list-disc list-inside mt-4">
                                        @foreach ($section['items'] as $item)
                                            <li>{{$item}}</li>
                                        @endforeach
                                    </ul>
                                    @break
                                @default
                                    <p class="mt-4">Unknown section type: {{$section['type']}}</p>
                            @endswitch
                        @endforeach
                    </div>
                </div>
            </div>


    </div>

</x-layout>
