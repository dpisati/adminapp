const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);

module.exports = {
    mode: "production"
};

let mix = require('laravel-mix');

mix.scripts([
    'resources/assets/js/jquery.js',
    'resources/assets/js/popper.js',
    'resources/assets/js/bootstrap.js',
    'resources/assets/js/app.js',
    ],'public/js/app.js').version();
mix.sass('resources/assets/sass/app.scss', 'public/css').version();