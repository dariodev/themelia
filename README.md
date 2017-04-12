Themelia
========

Author: dariodev  
Requires at least: WordPress 4.5  
Tested up to: WordPress 4.7  
Version: 1.1.4  
License: [GPLv2](http://www.gnu.org/licenses/gpl-2.0.html) or later  
Tags: one-column, two-columns, right-sidebar, left-sidebar, full-width-template, custom-menu, custom-colors, footer-widgets, editor-style, sticky-post, threaded-comments, translation-ready, featured-images, theme-options, e-commerce, blog

Description
-----------

Welcome to Themelia, a meticulously crafted and balanced WordPress theme for personal and professional blogging. Designed for authors, freelancers, agencies and everyone else. Supports WooCommerce, Easy Digital Downloads, Jetpack modules including Contact form and Infinite Scroll, Contact Form 7 and other popular plugins. Themelia has custom theme settings based on WordPress Customizer to change theme layout, colors, Google Fonts and much more. Typographic hierarchy and balance is established with the use of the modular scale. You can select different scales for different screen sizes. Themelia is built with search-engine optimization (SEO) in mind. It has consistent syntax structure, it's HTML5 valid, optimized for speed and SEO, utilizing most current HTML5 conventions and [Schema.org](http://schema.org) microdata. The theme is built on the rock-solid Hybrid Core theme framework.

### Features

Responsive Layout, Classic Menu, Mobile Menu, Social Menu, Breadcrumb Navigation, Featured Images, Custom Colors, Theme Options, Modular Scale Typography, Google Fonts, Post Formats

Theme Options - Customizer
--------------------------

The Customizer allows you to preview changes to your site before publishing them.

### Site Identity

-	Site Title and Description - change / show / hide
-	Logo - Upload image for site logo
-	Site Icon (used as a browser and app icon)

### Site Title and Header

-	**Header Layout** - Select layout for header elements (branding and main navigation). Stacked: left aligned, right aligned, centered. Inline: logo->menu, menu->logo.
-	**Site Header Background** - Background color for header area and **Site Header Separator** (Thin border between Site Header and Content Area).
-	**Site Title and Description** - Color and Size for Site Title and Tagline (Site Description). This is shown according to settings in the Site Identity. If you add site logo, Site Title and Tagline will hide, but always available for screen readers.

### Main navigation

-	**Main Navigation Typography** - Select Font family, size and other attributes.
-	**Main Navigation Colors** - Colors for top level links and dropdowns.

### Body Text and Links

-	**Body Text (Base typography settings.)** - Font Family, text and links color. **Default Font Family is Roboto.**

### Text Size - Modular Scale

A modular scale is a sequence of numbers that relate to one another in a meaningful way. You can set different base font and different modular scale for **Large screens** (desktops), **Mediums screens** (tablets and other medium size devices) and **Small screens** (smartphones and other small devices).  
 This theme provides four scales, Major Second, Minor Third, Major Third and Perfect Fourth.  
 Find more about the concept of [modular scale](http://alistapart.com/article/more-meaningful-typography), also check [Modular Scale calculator](http://www.modularscale.com/) and [Type Scale](http://type-scale.com/).

### Headings & Entry Titles

-	Color, weight, transform and letter spacing for **entry titles** and content **headings**.

### Breadcrumbs & Secondary Text

-	**Display Breadcrumbs** - on/off
-	**Secondary Text** - Text size for breadcrumbs.
-	**Secondary Text** - Size and color for entry meta, date, time, Read More link.

### Blog Settings

-	**Excerpt or Full Post Content** - Switch between displaying Excerpts or Full Content. Applies to the normal post format on the blog page, archives and search results.
    - **Excerpts (Default):** Use auto excerpt or manual excerpt. To manually add an excerpt to a post, simply write one in the Excerpt field under the post edit box. An excerpt can be as short or as long as you wish. When a post has no manual excerpt WordPress generates an excerpt automatically by selecting the first 55 words of the post.
    - **Content:** The full post content will be displayed, optionally you may use the More tag to create a teaser from the content that precedes the More tag.

### Layout

-	**Global Layout** - (2 columns - sidebar / content, 2 columns - content / sidebar, 1 column content). You can override this per page/post basis.
-	**Footer Widgets** - Choose the number of widget columns in the footer widget area. Each column can have any number of widgets.

### Background

-	**Background Color** - Pick body background color.
-	**Background Image** - Upload/Select body background image.

### Secondary Colors

-	Colors for separators and horizontal lines

### Menus

This panel is used for managing Navigation Menus for content you have already published on your site. You can create menus and add items for existing content such as pages, posts, categories, tags, formats, or custom links. Menus can be displayed in locations defined by the theme or in widget areas by adding a "Custom Menu" widget.

*This theme uses Navigation Menus `wp_nav_menu()` in three locations. Primary, Footer - Left and Footer - Right.*

**Locations:**

-	**Primary** Placed in the top header. For the Main site navigation.
-	**Footer - Left** Placed in the left footer. This is a one level menu (no dropdowns).
-	**Footer - Right - (optionally social menu)** Placed in the right footer. You can use it as a regular menu or as a Social Links menu. Inputting a custom link to your social profile the menu item will automatically display an icon for that social network (icons are provided by Ionicons icon font). To hide textual part of the link and display only the icon, add "icon-only" class to each menu item. If you add "icon-only" class, text will be visually hidden, but still available for screen readers. This is a one level menu (no dropdowns).

### Widgets

Theme has five widget areas:

-	**Primary sidebar** - The main sidebar. It is displayed on either the left or right side of the page based on the chosen layout.
-	**Subsidiary sidebar** - A sidebar located in the upper footer of the site. Optimized for one wide widget (and multiples thereof).
-	**Footer Widgets** - An area optimized for one, two, three or four widgets (and multiples thereof). Each column can have any number of widgets.
-	**Colophon sidebar** - Widget added in this sidebar will replace default theme copyright line in the site footer. Optimized for one widget. Best use: Text Widget (or similar) with auto paragraph and without title.
-	**Colophon Right sidebar** - A widget area located in the bottom-right footer of the site. Optimized for one widget.

### Static Front Page

This theme supports a static front page.

Installation
------------

1.	In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2.	Type in Themelia in the search form and press the 'Enter' key on your keyboard.
3.	Click on the 'Activate' button to use your new theme right away.
4.	Navigate to Appearance > Customize in your admin panel and customize to taste.

For more information about Themelia please go to [RelishPress website](https://relishpress.com/).

Notes for developers
--------------------

**Kirki Toolkit modification (original version is 2.3.7)**

-	Removed CodeMirror to reduce the size
-	Changed text-domain, from 'kirki' into 'themelia'
-	Removed enqueuing empty kirki-styles-. Changed $handle parameter in `wp_add_inline_style()`, added inline 'themelia-style'. The change is in the file "class-kirki-styles-frontend.php".
-	If you need CodeMirror it is safe to install and activate the official version of Kirki plugin. If you activate Kirki plugin, bundled library will not load.

**Unsemantic CSS Framework**

-	Media queries breakpoints slightly modifed
-	Grid container width and grid paddings modified

Copyright and License
---------------------

Themelia WordPress Theme, Copyright 2016 Dario Devcic  
Themelia is distributed under the terms of the GNU GPL

This program is free software: you can redistribute it and/or modify  
it under the terms of the GNU General Public License as published by  
the Free Software Foundation, either version 2 of the License, or  
(at your option) any later version.

This program is distributed in the hope that it will be useful,  
but WITHOUT ANY WARRANTY; without even the implied warranty of  
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the  
GNU General Public License for more details.

### Third Party Resources

[**HybridCore**](http://themehybrid.com/hybrid-core) v3.1.0, Copyright (c) 2008 - 2016, Justin Tadlock  
License: GNU GPL, Version 2 (or later)

[**Kirki Toolkit**](http://kirki.org/) v2.3.7, Copyright (c) 2016, Aristeides Stathopoulos  
Licenses: MIT/GPL2

[**Ionicons**](http://ionicons.com/) icon font v3.0.0-alpha.3, Copyright (c) 2016, Drifty  
License: MIT

[**Unsemantic CSS Framework**](http://unsemantic.com/), Created by Nathan Smith  
Licenses: MIT/GPL

[**SmartMenus jQuery Plugin**](https://www.smartmenus.org/) v1.0.1, Copyright 2016 Vasil Dinkov, Vadikom Web Ltd.  
Licenses: MIT

[**FitVids**](http://fitvidsjs.com/) v1.1, Copyright 2013, Chris Coyier  
License: [WTFPL](http://sam.zoy.org/wtfpl/)

**HTML5 Shiv** v3.7.0, Copyright 2014 Alexander Farkas  
Licenses: MIT/GPL2

All jQuery plugins are minified. Full source versions are also bundled in theme package. Full source versions will be loaded if `SCRIPT_DEBUG` is set to `TRUE` in your `wp-config.php` file. Otherwise, the `*.min.css` file is loaded.

**Image used in screenshot.png**

-	Featured image by [Redd Angelo](https://unsplash.com/@reddangelo16?photo=eY7ETwocMyU), licensed under [Creative Commons Zero](http://creativecommons.org/publicdomain/zero/1.0/)

All other resources and theme elements are licensed under the [GNU GPL](http://www.gnu.org/licenses/old-licenses/gpl-2.0.html), version 2 or later.
