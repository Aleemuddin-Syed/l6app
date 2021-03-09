@component('mail::message')
# Welcome to Laravel 6

If your are interested to reading the Post<br>
Here is showing the post<br>

@foreach($posts as $post)
# <a href="{{ route('posts.index', $post->slug )}}">{{ $post->title }}</a> 
@endforeach
@component('mail::button', ['url' => route('posts.index')])
View Post Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
