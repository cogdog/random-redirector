# Random Post Redirector Plugin for WordPress

-----
*If this kind of stuff has any value, please consider supporting me so I can do more!*

[![Support me on Patreon](http://cogdog.github.io/images/badge-patreon.png)](https://patreon.com/cogdog) [![Support me on via PayPal](http://cogdog.github.io/images/badge-paypal.png)](https://paypal.me/cogdog)

----- 

Who does not love a wee but of randomness in their site?

An utterly simple way too basic WordPress plugin that enables a /random URL to redirect to random post. I love having a means to link to a random post. The JetPack plugin provides this via adding ?random but JetPack is one big fat plugin. Oi.

So I made a simple one that provides this functionality on its own.

Just install to a hosted WordPress site and activate. Then, just add `/random`to your blog home URL and stand back for amazement. 

If you want to customize the url slug it uses, for now it requires an edit to the plugin (lame I know). Change the text for `"ramdom"` to be whatever URL you want

```
define("RANDOMSLUG", "random");
```

For example on my blog the random redirector URL is https://cogdogblog.com/digforbone


## Not Working?

Make sure you do not have an *existing* post with this permalink! The universe may implode. Well it won't, but watch out. You might need to customize the slug as described above.

If for some reason, the redirection does not work, first try the **actual** URL `http://mycoolbolg.org/?random=y` (or in my case `https://cogdogblog.com/?digforbone=y`).

If it redirects, it's working. YAY. If it just shows the home page, well something went wrong. Let me know with an issue.

If the short URL is not working, try a reset of permalinks in Settings -- permalinks (just re-save it).

## History

* v0.1 (Sep 21, 2022) First working version
* v0.2 (Sep 22, 2022) Added hook on plugin activation to flush rewrite rules, and also to clean out of plugin is deactivated






