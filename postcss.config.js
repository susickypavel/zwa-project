const tailwindcss = require("tailwindcss");
const purgecss = require("@fullhuman/postcss-purgecss");

const Encore = require('@symfony/webpack-encore');

const plugins = [
    tailwindcss("./tailwind.config.js"),
    require('autoprefixer'),
];

if (Encore.isProduction()) {
    plugins.push(purgecss({
        content: [
            "./templates/**/*.html.twig"
        ],
        safelist: ["dark", "dark-mode", "mode-dark"],
        whitelist: ["mode-dark", "dark", "dark-mode"],
        whitelistPatterns: [ /dark/],
        defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || []
    }));
}

module.exports = {
    plugins
};
