Chat Module for Bonfire
=======================

An AJAX Chat module for [Bonfire](http://cibonfire.com/): _Chitterchax_ hopes to be a robust chat with the ability to connect to multiple types of socket servers, falling back on a mysql/php/javascript system for users without socket support.

Chitterchax is still in the early Alpha development stages.

Origins
-------

Chitterchax is based off of [AJAX Chat](https://blueimp.net/ajax/): A fully featured Open Source chat application.

Goals
-----

* Fully featured and working chat out of the box
* Full Integration into [Bonfire](http://cibonfire.com/), making use of [Bonfire's](http://cibonfire.com/) genius libraries such as [Permissions](http://cibonfire.com/docs/files2/core_modules/permissions-txt.html), [Authentication](http://cibonfire.com/docs/files/core_modules/users/libraries/auth-php.html), [Events](http://guides.cibonfire.com/system_events.html), [Migrations](http://guides.cibonfire.com/migrations.html), [Contexts](http://cibonfire.com/docs/files2/general_topics/contexts-txt.html), and so forth.
* Bringing the Chat Interface up to speed with [HTML5](http://en.wikipedia.org/wiki/HTML5).
* Bumping up the JavaScript a notch by utilizing [jQuery](http://docs.jquery.com/Main_Page).
* Switching communications to [JSON](http://en.wikipedia.org/wiki/JSON): because [me](http://en.wikipedia.org/wiki/Loser_%28hand_gesture%29)+[JSON](http://www.json.org/)=[`&#x2665;`](http://www.youtube.com/watch?v=xECx-42Wlho&feature=related)
* Adding support for devilish technologies like [socket.io](http://socket.io/) for for socket communications.
* Ability for devs to easily customize/theme/extend/play to have full flexibility without a hassle.

Installation
============

1. Download and Extract the module folder (chitterchax) into the Bonfire Modules directory (./bonfire/modules/).

2. Log into Bonfire's Admin and install the Migrate the database for the chitterchax module to install the database tables.

3. Navigate to `http://{my-install-domain}/chitterchax` and enjoy.

Current Features
================

* Uses Bonfire's [Authentication](http://cibonfire.com/docs/files/core_modules/users/libraries/auth-php.html) Module
* [jQuery](http://jquery.com/) plugin functions to set chat elements without rewriting code. (Docs soon hopefully)
* Uses [CodeIgniter's](http://codeigniter.com/) [Smiley Helper](http://codeigniter.com/user_guide/helpers/smiley_helper.html).
* HTML5 [data-attributes](http://www.w3.org/TR/html5/elements.html#embedding-custom-non-visible-data-with-the-data-attributes)
* AJAX Communication via [JSON](http://www.json.org/)
* Light [BBCode](http://en.wikipedia.org/wiki/BBCode) [support](http://codeigniter.com/wiki/BBCode_Helper).

Distant Visions of the Future
-----------------------------

* HMVC modules::run() methods to stick a chat where ever you want it.
* Front end "Chat with a Support Dude Now" thingy with a back-end chat for the support dudes to monitor chats and respond to help request or praises.
* [Jabber Server support](http://blog.jwchat.org/jsjac/) ?
* ...

...Damn it. My crystal ball clouded up again, hindering my ability to spy on the future.

Want to Contribute?
===================

[Yes, please](https://github.com/thedudeguy/chitterchax/fork).