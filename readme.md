# 🚀 Tailwind CSS Laravel Front-end Preset

A Laravel frontend preset that scaffolds out new applications just the way I like 'em 👌🏻

What it includes:

- [Tailwind CSS](https://tailwindcss.com)
- [Purgecss](https://www.purgecss.com/), via [spatie/laravel-mix-purgecss](https://github.com/spatie/laravel-mix-purgecss)
- [Vue.js](https://vuejs.org/)
- Removes Bootstrap and jQuery
- Adds compiled assets to `.gitignore`
- Adds a simple Tailwind-tuned default layout template
- Replaces the `welcome.blade.php` template with one that extends the main layout
- Auth templates
- Error templates
- Sets @ alias in laravel mix, just like in vue-cli
- .editorconfig

## Installation
To install this preset, you must first require the composer dependency in your application. Laravel will automatically register the service provider for you.

```bash
composer require jpmhs/tailwind-preset
```

Now, apply the scaffolding either with the `tailwind` or the `tailwind:auth` preset. The `tailwind:auth` preset includes the authentication scaffolding normally generated when `php artisan make:auth` is executed.

```bash
php artisan preset tailwind
```
or

```bash
php artisan preset tailwind:auth
```

You can also specify the flag `--option=errors`, if you want to scaffold the 404, 500 and 503 error pages as well.

### Credits
- [Adam Wathan's Laravel Preset](https://github.com/adamwathan/laravel-preset)
- [Zak Nesler's Tailwind Preset](https://github.com/zaknesler/tailwind-preset)
