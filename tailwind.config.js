const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/views/user/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.jsx", // Include .jsx files
        "./resources/**/*.vue",
    ],
    safelist: [
        'bg-black',
        'text-white',
        'font-2xl', // This might be causing the issue (should be text-2xl)
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
