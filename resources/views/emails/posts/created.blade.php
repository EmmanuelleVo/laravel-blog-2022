<x-mail::message>
# Introduction

A new post has been created.

<x-mail::button :url="'http://blog.test/posts/'.$post->slug">
Visit {{ $post->title }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
