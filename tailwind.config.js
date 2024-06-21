/** @type {import('tailwindcss').Config} */
module.exports = {
     content: [
          './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
          './storage/framework/views/*.php',
          './resources/views/**/*.blade.php',
          './resources/views/**/**/*.blade.php',
          './resources/views/*.blade.php',
     ],

     theme: {
          extend: {
               spacing: {
                    sidebar: '250px',
               },
               colors: {
                    label : '#828282'
               },
               fontFamily: {
                    "krub-bold": "Krub-Bold",
                    "krub-light": "Krub-light",
                    "krub-medium": "Krub-Medium",
                    "krub-regular": "Krub-Regular",
                    "krub-semibold": "Krub-SemiBold",
               },
          },
     },

     plugins: [
     ],
};
