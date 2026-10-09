# IAG — WordPress theme

Custom theme for the **Image Analysis Group** website.
Pages are built from **modules** (ACF Pro Flexible Content), styles follow **ITCSS + BEM**, assets are compiled by **Gulp + Webpack + Dart Sass** into `dist/`.

## Contents

1. [Requirements](#requirements)
2. [Local setup](#local-setup)
3. [Commands](#commands)
4. [Git and deploy](#git-and-deploy)
5. [Folder structure](#folder-structure)
6. [How pages are built (modules)](#how-pages-are-built-modules)
7. [Adding a new module](#adding-a-new-module)
8. [Where to put new code](#where-to-put-new-code)
9. [SCSS](#scss)
10. [JavaScript](#javascript)
11. [PHP (`inc/`)](#php-inc)
12. [Templates, post types, settings](#templates-post-types-settings)
13. [Coding rules](#coding-rules)

---

## Requirements

| What | Version / notes |
|---|---|
| WordPress | 7.1.x |
| PHP | 7.4+ (developed on PHP 8.3) |
| Database | MySQL 8 (developed on MySQL 8.4) |
| Node.js | **20 LTS** (see `.nvmrc`; also builds on Node 24). Old Node versions (14/16) do not work. |
| npm | 10 (comes with Node 20) |
| Build tools | Gulp 4, Webpack 5, Dart Sass, Babel, Autoprefixer (all installed locally by `npm ci`) |
| Local server | Any (Laragon, LocalWP, Docker...). The default local URL in `gulpfile.js` is `http://iagnew.loc` |

**Plugins**

| Plugin | Why |
|---|---|
| Advanced Custom Fields **Pro** | Required. Page Builder, all custom fields, Theme Settings page |
| ACF Extended | Required. Layout thumbnails, columns in field groups |
| Yoast SEO | Breadcrumbs (`template-parts/breadcrumbs.php`) and primary "Resource Type" (`get_primary_category()`) |
| Contact Form 7 | Optional. Theme has styles and JS events for it; plugin CSS is disabled in `functions.php` |
| Select All Categories... (radio buttons) | Admin UX: single term selection in taxonomies |
| WP Mail SMTP | Mail delivery |

Forms on the site are **HubSpot** embeds pasted into *Theme Settings → HubSpot* (no plugin needed).
SVG upload support and the classic editor are built into the theme — do not install plugins for them.

---

## Local setup

1. Get a copy of the site (files + database) from the project lead. **Logins, passwords and keys are never stored in this repo.**
2. Put WordPress on your local server, import the database, update `siteurl`/`home` to your local URL.
3. Clone this repository into `wp-content/themes/iag`.
4. Install packages and build:

```bash
nvm use 20
npm ci
npm run build
```

5. If your local URL is not `http://iagnew.loc`, change `url` at the top of `gulpfile.js` (only used by BrowserSync, don't commit your personal URL).
6. In WP admin check *Custom Fields → Field Groups*: if any group shows **Sync available**, sync it (field groups live in `acf-json/`).

---

## Commands

| Command | What it does |
|---|---|
| `npm start` (`gulp`) | Dev build (with source maps) + watch SCSS, JS, fonts, images |
| `npm run watch` (`gulp watch`) | Same + BrowserSync on `http://localhost:8000` (proxy to the local URL) |
| `npm run build` (`gulp prod`) | Clean `dist/` and make the production build (minified, no inline source maps). **Run before every commit.** |
| `npm run lint:scss` / `lint:scss:fix` | Stylelint (WordPress rules) |
| `npm run lint:js` | ESLint (WordPress rules) |

Use `npm ci` (not `npm install`) to install exactly the versions from `package-lock.json`.

---

## Git and deploy

* Branches: `master` (production), `develop`, feature branches `feature/...`, `fix/...`, `chore/...`.
* **`dist/` is committed.** The server does not run Node: `.cpanel.yml` copies the repository as-is into the theme folder on the hosting when the deploy runs in cPanel (Git Version Control). So always commit the result of `npm run build` together with the source changes.
* `acf-json/` is committed too — every ACF change made in WP admin must be committed.

---

## Folder structure

```
iag/
├── acf-json/                ACF field groups (local JSON, synced automatically)
├── assets/                  SOURCES (edit here)
│   ├── fonts/               woff/woff2 files
│   ├── img/                 theme images, acfe-thumbnails/ (module previews 400x320 jpg)
│   ├── js/                  main.js, _components.js, _custom.js, _vars.js
│   │   ├── components/      one file = one UI component
│   │   ├── functions/       helpers imported by other files
│   │   ├── vendors/         local 3rd-party libs not available in npm
│   │   └── copy/            copied as-is to dist/js (admin.js)
│   └── scss/                main.scss, editor-styles.scss, admin-styles.scss, login.scss + ITCSS folders
├── dist/                    BUILD RESULT (never edit by hand)
├── inc/                     PHP logic, all loaded from functions.php
│   └── disables/            switched-off WP core features
├── template-parts/
│   ├── builder/             one file per Page Builder module ({layout_name}.php)
│   │   └── components/      parts reused inside modules (title, video)
│   ├── components/          cards and blocks reused by templates (expert, resource card...)
│   └── *.php                breadcrumbs, pagination, socials, svg sprite, builders loops...
├── *.php                    WordPress templates (header, footer, page, single-*, taxonomy-*, home...)
├── gulpfile.js              build configuration
└── style.css                theme header only (styles are in dist/css/main.css)
```

---

## How pages are built (modules)

* **Page Builder** — ACF Flexible Content field `builder`. Shown on pages (all templates except *System Page*).
* **Post Builder** — Flexible Content field `post_builder`. Shown on the **Resource** post type and on the *System Page* template. Layouts: `faq`, `main_content`.

Every layout of the builder is a **Clone** of a separate field group named `Module: {Name}` (these groups are *inactive* on purpose: they exist only to be cloned).

Rendering: `template-parts/builder.php` (or `post-builder.php`) loops over the rows and loads
`template-parts/builder/{layout_name}.php` — **the file name must be the same as the ACF layout name**.
Each row also gets `$args['index']` (position on the page, starts from 1).

**Common module fields** (copy them from an existing module, e.g. `Module: FAQ`):

| Field | Used for |
|---|---|
| `module_id` | `id` of the `<section>` (anchors) |
| `color_theme` | background: `white` / `gray` / `blue` / `orange` → classes `.bg-white`, `.bg-gray`, `.bg-blue`, `.bg-orange` |
| `module_uptitle`, `module_title`, `module_title_tag`, `module_subtitle` | module header; the title is printed by `template-parts/builder/components/title.php` |
| `module_header_alignment` | `left` / `center` / `right` → `.module-header.alignment-*` |

**Current modules**

| Layout (ACF + PHP file) | Root CSS class | SCSS file (`assets/scss/4-builder/`) |
|---|---|---|
| `hero` | `.m-hero` | `_hero.scss` |
| `banner` | `.m-banner` | `_banner.scss` |
| `simple_blocks` | `.m-simple-blocks` | `_simple-blocks.scss` |
| `simple_content` | `.m-simple-content` | `_simple-content.scss` |
| `simple_slider` | `.m-slider` | `_simple-slider.scss` |
| `simple_table` | `.m-table` | `_simple-table.scss` |
| `stars` | `.m-stars` | `_stars.scss` |
| `counter` | `.m-counter` | `_counter.scss` |
| `testimonials` | `.m-testimonials` | `_testimonials.scss` |
| `latest_resources` | `.m-latest` | `_latest-resources.scss` |
| `cells` | `.m-cells` | `_cells.scss` |
| `faq` | `.m-faq` | `_faq.scss` |
| `partnership` | `.m-partnership` | `_partnership.scss` |
| `media` | `.m-media` | `_media.scss` (+ `_c-video.scss`) |
| `follow` | `.m-follow` | `_follow.scss` |
| `cta` | `.m-cta` | `_cta.scss` |
| `locations` | `.m-locations` | `_locations.scss` |
| `contact_form` | `.m-cf` | `_contact_form.scss` |
| `experience` | `.m-experience` | `_experience.scss` |
| `main_content` (Post Builder) | `.main-content` | `_main-content.scss` |

Shared module styles (`.module`, `.module-header`, `.bg-*`, chips, images) are in `4-builder/_!base-components.scss`.

---

## Adding a new module

Example: a module called **Logos**.

1. **ACF field group** — *Custom Fields → Add New*, title `Module: Logos`. Add the common module fields (see table above) and the module's own fields. Set the group to **inactive** (it is only cloned). Save → `acf-json/group_xxx.json` is created.
2. **Add it to the builder** — open *Page Builder* → `builder` field → *Add Layout*: label `Logos`, name **`logos`** (snake_case). Inside the layout add one **Clone** field → select `Module: Logos`, display *Seamless*.
3. **Template** — create `template-parts/builder/logos.php`:

```php
<?php
$module_id   = get_sub_field( 'module_id' ) ?: '';
$color_theme = get_sub_field( 'color_theme' ) ?: 'white';
?>
<section id="<?php echo esc_attr( $module_id ); ?>" class="module m-logos bg-<?php echo esc_attr( $color_theme ); ?>">
	<div class="container">
		<?php get_template_part( 'template-parts/builder/components/title' ); ?>
		<!-- module content: .m-logos__list, .m-logos__item ... -->
	</div>
</section>
```

4. **Styles** — create `assets/scss/4-builder/_logos.scss`, root block `.m-logos`, elements `.m-logos__item`, modifiers `.m-logos--dark`. No import needed: folders are imported by glob in `main.scss`.
5. **JS (only if needed)** — a slider init goes to the *Sliders* section of `assets/js/_custom.js`; bigger logic goes to `assets/js/components/logos.js` + `import './components/logos';` in `_components.js`.
6. **Admin preview** — add a 400×320 `logos.jpg` to `assets/img/acfe-thumbnails/` and add `'logos'` to `$ACFE_SECTION_BUILDERS` in `inc/acf.php`.
7. `npm run build`, check the module on a page, commit the template, SCSS, JS, image, `acf-json/` and `dist/`.

A part reused **inside several modules** → `template-parts/builder/components/` (+ styles `4-builder/_c-{name}.scss`, or `_!base-components.scss` if small).

---

## Where to put new code

| I need to add... | Put it in |
|---|---|
| A Page Builder module | `template-parts/builder/{layout}.php` + `assets/scss/4-builder/_{layout}.scss` |
| A part used inside modules | `template-parts/builder/components/` + `4-builder/_c-{name}.scss` |
| A card / block reused by templates | `template-parts/components/{name}.php` + `assets/scss/5-components/_{name}.scss` |
| A tiny UI piece (link, placeholder...) | `assets/scss/5-components/_!atoms.scss` |
| Styles for one page / single / archive | `assets/scss/6-templates/_{template}.scss` |
| Header / footer / menu styles | `assets/scss/2-layouts/` |
| Styles for a plugin or library | `assets/scss/3-vendors/_{plugin}.scss` |
| A color, font, breakpoint | `assets/scss/0-settings/_!variables.scss` (see rules below) |
| A mixin / function | `assets/scss/0-settings/_mixins-general.scss` |
| A JS component | `assets/js/components/{name}.js` + import in `_components.js` |
| Small page script / slider init | `assets/js/_custom.js` |
| A JS helper function | `assets/js/functions/{name}.js` (export it, import where needed) |
| An npm library | `npm i {lib}` + import in `_custom.js` (or in the component that uses it) |
| JS for WP admin | `assets/js/copy/admin.js` |
| PHP hooks / helpers | the matching file in `inc/` (new file → `require` it in `functions.php`) |
| A post type or taxonomy | `inc/custom-post-type.php` |
| Enqueue a script/style | `inc/scripts-styles.php` |
| A new SVG icon | `<symbol>` in `template-parts/svg.php`, use with `<svg><use xlink:href="#id"></use></svg>` |
| Fonts | files to `assets/fonts/`, `@font-face` to `0-settings/_fonts.scss` |
| Images used by the theme | `assets/img/` (copied to `dist/img/`, use `IT_IMG` constant in PHP) |

---

## SCSS

Entry files (each compiles to `dist/css/{name}.css`):

* `main.scss` — the site.
* `editor-styles.scss` — TinyMCE (classic editor) content styles.
* `admin-styles.scss` — WP admin tweaks (ACF/ACFE UI). Standalone: does not import theme settings.
* `login.scss` — login screen.

ITCSS layers in `main.scss` (lower number = more generic, loaded first):

| Folder | Content |
|---|---|
| `0-settings` | variables, fonts, `rem()` / `clamp-rem()` functions, mixins. No CSS output except `@font-face` and `:root` vars |
| `1-generic` | reset, HTML elements, WP core classes, typography, editor formats, forms, buttons, utilities |
| `2-layouts` | Bootstrap grid (container/row/col only), header, navigation, footer |
| `3-vendors` | Contact Form 7, Fancybox, Nice Select, Swiper |
| `4-builder` | Page Builder modules (`.m-*`) and module components (`_c-*`) |
| `5-components` | reusable components (cards, modal, tabs, accordion...) |
| `6-templates` | page / post type / archive specific styles |

Files starting with `_!` are loaded first inside their folder.

**Variables (`0-settings/_!variables.scss`)**

* The **brand palette** (`$iag-navy-*`, `$iag-orange-*`, `$iag-gray-*`, 50–900) is the single source of truth. Use palette tokens directly; the full scales are kept even if some steps are not used yet.
* **Roles** — `$primary`, `$secondary`, `$color-text`, `$color-link` — aliases for global roles. Change a role here, not in components.
* **Extra colors** — a few colors outside the palette (`$grey-border`, `$green`, `$red`...). Add a new variable only if the color really is new; never create a second variable with the same value.
* Units: write sizes with `rem(16)` / `rem(16 24)`; fluid sizes with `clamp-rem(min, max)`.
* Breakpoints: `md 640`, `lg 1024`, `xl 1440`, `xxl 1920`. Use `@include min(lg) { }` / `@include max(lg) { }` (`max` = value − 1px).
* Transitions: `@include tr;` or `$default-transition`.

**Naming**: BEM. Modules `.m-{name}`, `.m-{name}__element`, `.m-{name}--modifier`; components without prefix (`.expert-card`, `.modal`); JS hooks `.js-*` (no styles on `.js-*` classes unless the component owns them).

---

## JavaScript

`assets/js/main.js` is the Webpack entry (bundled to `dist/js/main.js`, jQuery is a WP dependency):

* `_components.js` — imports all components from `components/`.
* `_custom.js` — npm libraries (Swiper, Fancybox), Nice Select, share button, **all Swiper sliders**, animated counters, sticky header.
* `_vars.js` — shared variables (`htmlEl`, `bodyEl`, JS breakpoints `bp`).

Components: `accordion` (`.js-accordion`), `tabs` (`.js-tabs`), `modal` (`.js-modal-open`, `.modal`), `table-of-content`, `navigation` (mega menu / mobile menu), `header-scrolled`, `adminbar`, `to-top`, `cf7-events`, `skip-link-focus-fix`.

AJAX: `wpApiSettings.ajaxUrl` and `wpApiSettings.nonce` are available in JS (`inc/scripts-styles.php`). Add PHP handlers with `wp_ajax_{action}` / `wp_ajax_nopriv_{action}` in a new `inc/ajax.php` and check the nonce.

---

## PHP (`inc/`)

All files are loaded from `functions.php`.

| File | Content |
|---|---|
| `after-theme-setup.php` | theme supports, nav menu locations, body class with post slug, excerpt length, `get_primary_category()` |
| `acf.php` | Theme Settings options page, ACFE layout thumbnails, disabled ACFE modules |
| `custom-post-type.php` | CPTs **Expert** (+ taxonomies Expertise, Therapeutic Area, Indicator Area), **Leadership**, **Resource** (+ taxonomy **Source** = "Resource Type") |
| `disables.php` + `disables/` | switched-off WP features (emoji, embeds, XML-RPC, Gutenberg, block widgets, dashboard widgets, auto-updates...) |
| `editor.php` | TinyMCE style formats (titles, text, buttons, lists) and text colors |
| `help-func.php` | helpers: `it_posted_on()`, `it_excerpt()`, `it_phone_cleaner()`, `[email]` shortcode, `it_link_rel()`, `it_console_log()`... |
| `lazy-load.php` | custom lazy load for images and iframes (add class `no-lazyload` to skip) |
| `login.php` | login screen logo and link |
| `scripts-styles.php` | enqueue of `main.css`, `main.js`, admin assets |
| `seo.php` | Source archive pagination redirects, Complianz URL fix, security headers |
| `svg-support.php` | SVG upload and preview in Media Library |
| `walker.php` | `IAG_Mega_Menu_Walker` — header mega menu |

Constants: `IT_DIR`, `IT_URL`, `IT_DIST`, `IT_CSS`, `IT_JS`, `IT_IMG`.

---

## Templates, post types, settings

| Template | Used for |
|---|---|
| `page.php` | pages → Page Builder |
| `home.php` (*Template Name: Resource Hub*) | resources hub page |
| `template-parts/system-page.php` (*Template Name: System Page*) | text pages with table of contents → Post Builder |
| `single-resource.php` | Resource → Post Builder |
| `single-expert.php`, `single-leadership.php` | Expert / Leadership profiles |
| `taxonomy-source.php` | Resource Type archive (all resources of the type, no pagination) |
| `single.php`, `index.php`, `search.php`, `404.php` | WordPress defaults |

**Theme Settings** (ACF options page in admin): header logo and buttons, footer logo/menus toggles, socials and contacts, default CTA, counters, HubSpot form embed codes.

**Menus**: Main Nav (mega menu, items have extra ACF fields), Footer Top, Footer Columns 1–3, Footer Copyright.

**Tracking**: Google tag, Microsoft Clarity and HubSpot scripts are in `header.php`.

---

## Coding rules

* Work only in this theme. Never edit WordPress core or plugin files.
* Escape all output (`esc_html`, `esc_attr`, `esc_url`, `wp_kses_post`) and sanitize all input. For translated strings use `esc_html_e()` / `esc_html__()` with the text domain **`_iag`**.
* Never edit `dist/` by hand — change `assets/` and build.
* No commented-out code and no unused files/variables: delete them (git keeps the history).
* Never commit logins, passwords, API keys or tokens (also not in comments).
* Formatting: `.editorconfig` (tabs, LF). PHP follows WordPress Coding Standards (`phpcs.xml.dist`).
