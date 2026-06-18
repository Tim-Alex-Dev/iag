IT Starter
===

**_IT Starter_** is a starter theme for web development. By default, it depends on **ACF Pro** plugin for creating custom layouts (instead of WP Gutenberg).

##### Table of Contents:

*   [Prerequisites](#prerequisites)
*   [Installation](#installation)
*   [Gulp](#gulp)
*   [INC](#inc)
*   [Fonts](#fonts)
*   [Images](#images)
*   [CSS](#css)
*   [JavaScript](#javascript)
*   [ACF Pro](#acf-pro)
*   [WPML](#wpml)
*   [WooCommerce](#woocommerce)

## Prerequisites

Required plugins:

*   **Advanced Custom Fields Pro** (ACF Pro).
*   **[Advanced Custom Fields: Extended](https://wordpress.org/plugins/acf-extended/)** (ACF Extended).
*   **Yoast SEO**.
*   Multilingual: **WPML**.
*   E-commerce: **WooCommerce**.

**Not needed (!)** plugins (functionality is already bundled into the theme):

* Classic Editor.
* SVG Support / Safe SVG.

Recommended plugins:

* Development only: **[ACF Theme Code Pro](https://hookturn.io/downloads/acf-theme-code-pro/)**
* Contact forms: **Contact Form 7** or **Gravity Forms**.
* Website migration: **[Duplicator](https://wordpress.org/plugins/duplicator/)**

## Installation

* Install WordPress.<br>
    **Important:** If your project is not using English as primary language, make sure to run installation in proper language. Then, login to your admin profile, and change `Language` field to `English`.
* For security reasons, instead of default `admin` use project related username with `admin-` prefix (e.g. `admin-starter`).
* Clone or download this repository.<br>**Important:** When cloning, make sure to remove all old commits.
* Rename theme folder to project name and update **style.css**.
* Review **package.json** file, and install the necessary Node.js dependencies: `npm i`.
* Replace original Text Domain `_it_start` with your custom name. In **gulpfile.js** change textdomain with your custom name, and run gulp task: `gulp textdomain`.
* Create Git repository for the project, and start tracking theme files.
* Setup Gitlab CI/CD (if needed). Make sure you have `.gitlab-ci.yml` file theme root folder, and add needed variables in project's CI/CD Settings: `FTP_HOST`, `FTP_USER`, `FTP_PASS`.

## Gulp

Available commands:

*   `gulp` : run gulp watcher in Development mode.
*   `gulp watch` : start BrowserSync with gulp watcher in Development mode.
*   `gulp prod` : re-create `dist` folder, compile assets for Production (optimized and minified).

## INC

All files from this folder are included in **functions.php**. Disable not needed items there.

* **after-theme-setup.php** - Setup nav menus. Add custom image sizes only(!) if needed. Try to use default WP image sizes instaed (`thumbnail`, `medium`, `medium_large`, `large`, `1536x1536`, `2028x2048`, `full`).
* **acf.php** - ACF Extended Layouts Thumbnails in \[Page Builder\] should be added in theme folder (not in WP admin). First, add all ACF Flexible Content layout names (e.g. `hero`) into `$ACFE_SECTION_BUILDERS` array. Then copy JPG images with the relevant names (e.g. `hero.jpg`) into `assets/img/acfe-thumbnails` folder.
* **ajax.php** - Add your custom AJAX functions here.
* **custom-post-type.php** - Create needed custom post types and taxonomies. Make sure to set correct names, parameters for visibility, archive page, slug rewrite, etc.
* **disables.php** - Comment any disables that should be enabled for your specific needs (e.g. Comments, Lazy Load, etc).
* **editor.php** - This theme comes with some predefined style formats for Titles, Text, Buttons, Lists. You can add more or modify existing. Make sure to update corresponding styles in **1-2-typography/\_editor.scss** file.
    Also modify custom colors, which are added into TinyMCE editor text color selector.
* **help-func.php** - This theme comes with some predefined custom helper functions for displaying image placeholder, post dates, post author, post categories and tags, custom excrpt, phone and email fields modifying. You can add more or modify existing.
* **lazy-load.php** - Custom lazyload for images and iframes. If you want to disable custom lazyload for any image, just add a class `no-lazyload` to it.
* **login.php** - Customization of login screen.
* **scripts-styles.php** - Scripts and styles enqueue | dequeue.
    **Important:** use `$ver = time();` only for development, and `'1.0.0'` format for production (to keep style caching on the server).
* **widgets.php** - This theme comes with some predefined 'Language Switcher' widget, which should be removed if no multilingual is needed.
* **woo.php** - Declararion of WooCommerce support for this theme. Custom WooCommerce overrides should be added here.

## Fonts

We use only `woff` and `woff2` font formats.
Recommended online tool for font conversion: **[Transfonter](https://transfonter.org/)**.

## Images

Make sure to optimize images before adding them to `assets/img` folder.
Possible online tool for image optimization (jpg, png, gif, svg, webp): **[Compressor](https://compressor.io/)**.

**SVG sprite**: It's recommended to add constantly used SVG icons (e.g. socials, logo, navigation arrows, etc) into a single SVG sprite, for further inline usage in the templates (e.g. `<svg><use xlink:href="#logo"></use></svg>`). You can add correctly prepared icons into **template-parts/svg.php** file.

## CSS

SCSS syntax is used for speed up work with styles. This theme uses modified **[ITCSS](https://www.xfive.co/blog/itcss-scalable-maintainable-css-architecture/#what-is-itcss)** approach. Try to follow **[BEM](https://getbem.com/introduction/)** principles for CSS class naming (e.g. `.site-header`, `.site-header__section`, `.site-header__section-element`, `.site-header__section--dark`).

We are using REM units globally instead of pixels. You should use custom SASS `rem` function for this (syntax examples are provided in **0-settings/_!rem-calc.scss**). Use REM units for everything, except grid (container, row, column width and gaps) and small border-width values (e.g. keep `border-width: 1px`). Use the following notation for declaring CSS variables with `rem` values: `--my-css-var: #{rem(50)};`. 

For responsive font sizes, it's recommended to use the custom SASS `clamp-rem` function ((syntax examples are provided in **0-settings/_!rem-calc.scss**)), which has two required attributes that describe min and max font sizes between 2 optional attributes that describe min and max browser width. Default min-width is **md** breakpoint and max-width is **xl** breakpoint. Use only pixel values for `clamp-rem` function. Find more information about **[CSS Clamp](https://css-tricks.com/min-max-and-clamp-are-css-magic/)** and **[Online Clamp Calculator](https://websemantics.uk/tools/responsive-font-calculator/)**.

* **main.scss** - Main theme styles file.
* **admin-styles.scss** - Custom Admin styles (ACF extra styling, etc).
* **editor-style.scss** - Applying theme styles to WP WYSIWYG.
* **login.scss** - Customize login screen by adding client's logo (Clients appreciate such attention to their individuality 😊).
* **0-settings** - Setup theme SCSS variables (colors, font styles, breakpoints, container width, etc), global CSS variables and fonts.
* **1-generic** - Enable all needed Bootstrap utilities in **1-4-utilities/\_bootstrap-utilities.scss** file.
    *   **1-1-base** - Add HTML tag styles and core WP styles.
    *   **1-2-typography** - Styles for headings and styled HTML tags. Adjust custom editor style formats.
    *   **1-3-forms** - Styles for inputs and buttons. Contact Form 7 / Gravity Forms custom styles should be added in **3-vendors** folder.
    *   **1-4-utilities** - Enable all needed Bootstrap utilities here. Adjust helper classes with theme colors: text color classes and background color classes.
* **3-vendors** - 3rd party plugins should be added here (by importing styles from **node\_modules** or copying CSS/SCSS files).
* **4-builder** - styles for ACF Flexible Content layouts should be added here as separate files. ACF components (which are building blocks for layouts) should be added as separate files with `_c-` prefix (e.g. `_c-video.scss`). Simple ACF components can be added into **\_!base-components.scss** file.
* **5-components** - Minor custom components can be added into **\_!atoms.scss** file.
* **6-templates** - styles for specific pages, CPT singles, archives, custom page templates, 404, search results, etc.

## JavaScript

Gulp uses **Webpack** to build the JS code.

* **main.js** - this is a result file. There's no need to change it.
* **copy** folder - files from this folder will be copied into **dist/js** folder. So they can be enqueued into **scripts-styles.php** file (e.g. `admin.js` file for usage only in WP admin).
* **functions** folder - helper functions from this folder should be imported into other component files.
* **\_vars.js** - should contain the basic project variables.
* **\_vendors.js** - you can connect third-party libraries through `npm` and import connections into this file. If some library is not in `npm` or you just need to connect something with a local file, put it in the **vendors** folder and import it in the same way, but with the path to the file.
* **\_components.js** - It's recommended to divide JS code into components (separated files with their own functionality). Place such files in **components** folder, and then import them into this file.
    You can find a bunch of custom components (e.g. accordion, modal, tabs, toggle) in **components** folder, and see their usage examples on our **[Demo Page](https://starter.itmonks.dev/demo/)**.
    *   **ajax.js** - add your custom AJAX scripts here.
    *   **navigation.js** - scripts for header navigation.
* **\_custom.js** - add all your custom scripts into this file.

## ACF Pro

This theme comes with predefined ACF Flexible Content **_Page Builder_** and a number of layouts inside (e.g. Hero, Text and Media, Text Columns).

*   Make sure to have `Auto Sync = json` for every ACF field group for storing fields in theme folder `acf-json`.
*   Use prefixes for Field Groups names (e.g. `Module:` - for flexible content layouts, which should be cloned into _Page Builder_; `Component:` - for components, which are expected to be cloned into _Page Builder_ modules or other Field Groups); `Single:` - for post types singles (incl. Post); `Archive:` - for post type archives; `Taxonomy:` - for all taxonomies (incl. Category and Tag); `Page Template:` - for page templates.
*   PHP Templates for ACF fields:
    *   **template-parts/builder** - add _Page Builder_ modules into this folder.
    *   **template-parts/builder/components** - add ACF components into this folder.

## WPML

We are using **WPML** plugin for multilingual functionality.
Recommended article: [Translate Sites Built with Advanced Custom Fields (ACF)](https://wpml.org/documentation/related-projects/translate-sites-built-with-acf/)

## WooCommerce
WIP...
