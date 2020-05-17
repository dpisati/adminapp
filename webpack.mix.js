const mix = require("laravel-mix");

mix.sourceMaps()
    .js("node_modules/popper.js/dist/popper.js", "public/js")
    .sourceMaps();

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/main.scss", "public/css");

module.exports = {
    mode: "production"
};
