import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/* @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/protonemedia/laravel-splade/lib/**/*.vue",
        "./vendor/protonemedia/laravel-splade/resources/views/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        // "./app/Forms/*.php",
        // "./app/Tables/*.php",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            colors: {
                primary: {"50":"#eff6ff","100":"#dbeafe","200":"#adffca","300":"#6effa1","400":"#14fa51","500":"#07de4b","600":"#06ba3c","700":"#00941e","800":"#088521","900":"#0b661d","950":"#054512"}
            }
        },
    },

    plugins: [
        forms,
        typography,
        require('flowbite/plugin'),
    ],
    darkMode: 'class',
};
