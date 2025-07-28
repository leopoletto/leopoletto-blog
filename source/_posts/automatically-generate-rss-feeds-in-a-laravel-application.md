---
extends: _layouts.post
section: content
title: "How to Automatically Generate RSS Feeds in Laravel"
date: 2025-01-15
description: Learn how to easily add an RSS feed to your Laravel app using Spatie’s laravel-feed package. Step-by-step guide with examples and best practices!
published: true
featured: true
type: article
image: "how-to-generate-rss-feeds-in-a-laravel-application.webp"
cover: "how-to-generate-rss-feeds-in-a-laravel-application.webp"
categories: ['tutorials']
slug: laravel-rss-feed-generation
---

One handy way of keeping users up-to-date on your content is creating an RSS feed.
It allows them to sign up using an RSS reader.
The effort to implement this feature is worth considering because 
the website will have another content distribution channel.

Spatie, a well-known company by creating hundreds of good packages for Laravel.
One of them is [laravel-feed](https://github.com/spatie/laravel-feed).
Let's see how it works:

## Installation

The first step is to install the package in your Laravel Application:

```bash
composer require spatie/laravel-feed
```
Then you must publish the config file:

```bash
php artisan vendor:publish --provider="Spatie\Feed\FeedServiceProvider" --tag="feed-config"
```
## Usage

Let's break down the possibilities when configuring a feed.

### Creating feeds

The config file has a `feeds` key containing an array in which each item represents a new feed, and the key is the feed name.

Let's create a feed for our Blog Posts:

*`app/config/feed.php`*
```php
return [
    'feeds' => [
        'blog-posts' => [
            //...
        ],
        'another-feed' => [
            //...
        ]   
    ]
];
```

The key `blog-posts` is also the name of the feed in which its value contains the configuration as an Array. 
You can create more feeds if needed, but for the sake of this article, let's focus on `blog-posts`.

That being said, for our model to work,
we need
to implement the interface `Spatie\Feed\Feedable`.
It has a signature for a public method named `toFeedItem`
which must return an instance of `Spatie\Feed\FeedItem`.

Below is an example of how to create a `FeedItem` object:

*`app/Models/BlogPost.php`*
```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class BlogPost extends Model implements Feedable
{
    //...
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->summary)
            ->updated($this->updated_at)
            ->link(route('blog-posts.show', $this->slug))
            ->authorName($this->author->name)
            ->authorEmail($this->author->email);
    }
}
```

Now we must create a class with a static method which is going to return a collection of `App\Models\BlogPost` objects:

*`app/Feed/BlogPostFeed.php`*
```php
namespace App\Feed;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Collection;

class BlogPostFeed
{
    public static function getFeedItems(): Collection
    {
        return BlogPost::all();
    } 
}
```

Back to our config file, the first key for our feed configuration is `items`,
which defines where to retrieve the collection of posts.

*`app/config/feed.php`*
```php
return [
    'feeds' => [
        'blog-posts' => [
            'items' => [App\Feed\BlogPostFeed::class, 'getFeedItems']
            //...
        ],
    ]
];
```

Then you have to define the URL:

*`app/config/feed.php`*
```php
return [
    'feeds' => [
        'blog-posts' => [
            //'items' => [App\Feed\BlogPostFeed::class, 'getFeedItems'],
            'url' => '/posts', //https://domain.com/posts
            //...
        ],
    ]
];
```

Register the routes using a macro `feeds` included in the package:

*`app/routes/web.php`*
```PHP
//...
Route::feeds();  //https://domain.com/posts
```

If you wish to add a prefix:

*`app/routes/web.php`*
```PHP
//...
Route::feeds('rss'); //https://domain.com/rss/posts
```

Following, you must add a `title`, `description` and `language`:

*`app/config/feed.php`*
```php
return [
    'feeds' => [
        'blog-posts' => [
            //'items' => [App\Feed\BlogPostFeed::class, 'getFeedItems'],
            //'url' => '/posts',
            'title' => 'My feed',
            'description' => 'The description of the feed.',
            'language' => 'en-US',
            //...
        ],
    ]
];
```

You can also define the format of the feed and the view that will render it.
The acceptable values are `RSS`, `atom`, or `JSON`:

*`app/config/feed.php`*
```php
return [
    'feeds' => [
        'blog-posts' => [
            //'items' => [App\Feed\BlogPostFeed::class, 'getFeedItems'],
            //'url' => '/posts',
            //'title' => 'My feed',
            //'description' => 'The description of the feed.',
            //'language' => 'en-US',
            'format' => 'rss',
            'view' => 'feed::rss',
            //...
        ],
    ]
];
```

There are a few additional options:

*`php`*
```php
 /*
 * The image to display for the feed. For Atom feeds, this is displayed as
 * a banner/logo; for RSS and JSON feeds, it's displayed as an icon.
 * An empty value omits the image attribute from the feed.
 */
'image' => '',

/*
 * The mime type to be used in the <link> tag. Set to an empty string to automatically
 * determine the correct value.
 */
'type' => '',

/*
 * The content type for the feed response. Set to an empty string to automatically
 * determine the correct value.
 */
'contentType' => '',
```

The final result of the config file should look like below:

*`app/config/feed.php`*
```php
return [
    'feeds' => [
        'blog-posts' => [
            'items' => [App\Feed\BlogPostFeed::class, 'getFeedItems'],
            'url' => '/posts',
            'title' => 'My feed',
            'description' => 'The description of the feed.',
            'language' => 'en-US',
            'format' => 'rss',
            'view' => 'feed::rss',
            'image' => '',
            'type' => '',
            'contentType' => '',
        ],
    ]
];
```

## Automatically generate feed links

Feed readers discover a feed looking for a tag in the head section of your HTML documents:

*`html`*
```html
<link rel="alternate" type="application/atom+xml" title="News" href="/rss/posts">
```

Add this to your `<head>`:

*`blade`*
```php
@include('feed::links')
```

Alternatively, use the available blade component:

*`blade`*
```html
<x-feed-links />
```

## Conclusion

In this article,
you've learned how easy it is to add an RSS feed to your website using the `laravel-feed` package from Spatie.

If you have any comments,
you can share them in the [discussion on Twitter](https://twitter.com/leopoletto/status/1683975416296493062).
