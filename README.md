# DevTodo2 Web Extenstion

[DevTodo2](https://github.com/alecthomas/devtodo2) is an amazing command line task manager for Linux.

This is the web version of the same so that you can view / edit / search / re-order your todo list using any web browser.

You can run it as standalone program or alongside `DevTodo2` (it is 100% compatible with the `.todo2` files created by `DevTodo2`)  

## Screenshot

![Screenshot](./screenshot.gif)


## Benefits

- Maintains a separate todo file in each directory (so easy to create a todo list per project / folder)
- No messy installation, just clone the repo and you're set! 
- Compatible with command line tool `DevTodo2`, so you can switch between GUI and command line seamlessly. 
- Super simple .todo2 JSON file format (can be hand edited or piped to any program as needed).
- Works in every resolution or window size thanks to responsive CSS!
- About 100 lines of super simple PHP / Vuejs code (great for learning as a weekend project)
- Should work easily on Windows / Mac too (just need to port todo2-web bash script ~ about 10 lines)

## Requirements

- PHP 7+

If you don't have PHP on your machine just run `sudo apt install php`

## Installation

Just clone this repo and add the directory to your path (update `$PATH` in `.bashrc`)

````
git clone git://github.com/san-kumar/devtodo2-web-extension.git ~/devtodo2-web-extension
echo 'PATH="$PATH:~/devtodo2-web-extension"' >> ~/.bashrc
source ~/.bashrc
cd ~/your-project-dir
todo2-web
````

Make sure you understand what the commands do before you start copy-pasting ;)

## Running

Just run `todo2-web` in any directory in which you want to create a new todo list. It should open up your web browser and you should see your todo list!

The program basically creates/reads a `.todo2` file (JSON) using the PHP and opens the editor in your favorite web browser.

## Uninstalling

Just delete the `~/devtodo2-web-extension` directory and undo any changes to `$PATH`. Also run `killall php` to stop the PHP server.

## About

It is just a 100 lines of PHP & Javascript. The front-end uses Vuejs and Milligram framework. Took me less than 2 hours to write it including this README file &#x263A;
 

Made it to scratch my own itch but in case someone finds it useful let me know!

## Credits

Credit goes to [Alec Thomas](https://github.com/alecthomas) for his wonderful software and inspiration.