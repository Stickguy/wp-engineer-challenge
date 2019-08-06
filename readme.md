# Mediavine WordPress Engineer Pair Coding Challenge

## Do the following:
1. Create a new endpoint to pull random posts in `class-routes.php`
   1. Endpoint should be directed to `http://{URL.test}/wp-json/mv-challenge/v1/random/{number_of_posts}`
   1. This read-only endpoint will randomly select posts from the site, using the number of posts as the limit
   1. Add the ability to limit results based on additional URL params as response data for both `author` and `category`
   1. Return the response with the found posts
1. Create a new shortcode to pull random posts in `class-shortcodes.php`
   1. Add shortcode named `mv_random_posts` to output an unordered list of the random posts
   1. Use the newly created endpoint to retrieve this data and output on the page
   1. Add parameters to filter by `limit`, `author`, and `category`
   1. Add a filter to change the output to an ordered list
