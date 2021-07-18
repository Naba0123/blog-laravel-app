@php
$description = '';
if (isset($_description)) {
    $description = $_description . ' | ';
}
$description .= setting('blog_description');

@endphp

<meta name="description" content="{{ $description }}">
<meta name="twitter:card" content="{{ $description }}">
@if ($v = setting('twitter_site_screen_name'))
    <meta name="twitter:site" content="{{ $v }}">
@endif
@if ($v = setting('twitter_creator_screen_name'))
    <meta name="twitter:creator" content="{{ $v }}">
@endif
