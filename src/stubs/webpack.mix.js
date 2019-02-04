const path = require("path");
const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
require("laravel-mix-purgecss");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .setPublicPath("public")
  .js("resources/js/app.js", "public/js")
  .sass("resources/sass/app.scss", "public/css")
  .options({
    processCssUrls: false,
    postCss: [tailwindcss("./tailwind.js")]
  });

//production versioning
if (mix.inProduction()) {
  mix.purgeCss().version();
}

/*
 |--------------------------------------------------------------------------
 | Configuration
 |--------------------------------------------------------------------------
 |
 */

mix.webpackConfig({
  devServer: {
    disableHostCheck: true,
    headers: {
      "Access-Control-Allow-Origin": "*"
    }
  }
});

// Resolve alias @ to js directory
mix.webpackConfig({
  resolve: {
    extensions: [".js", ".vue", ".json"],
    alias: {
      "@": path.resolve(__dirname, "resources/js")
    }
  }
});

// BrowserSync, if needed.
// mix.browserSync({
//   proxy: "localhost",
//   open: false,
//   notify: false,
//   files: ["resources/**/*"]
// });
//
