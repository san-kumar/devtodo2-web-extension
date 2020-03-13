# DevTodo2 Web Extenstion

DevTodo2 is an amazing command line task manager for Linux.

This is a web plugin for it so that you can view / edit / search your todo list using the browser too.

## Screenshots



## Requirements

- PHP 7+

If you don't have PHP on your machine just run `sudo apt install php`

## Installation

Just clone this repo and add the directory to your path (update `$PATH` in `.bashrc`)

````
git clone git://github.com/san-kumar/devtodo2-web-extension.git ~/devtodo2-web-extension
echo "\$PATH="$PATH:~/devtodo2-web-extension" >> ~/.bashrc
source ~/.bashrc
todo2-web
````

Make sure you understand what the commands above do before you copy-pasting ;)

## Running

Just run `todo2-web` in any directory that has a `.todo2` file in it.

The program basically reads and modifies `todo2-web` using the PHP script.

## Uninstalling

Just delete the `~/devtodo2-web-extension` directory and undo any changes to `$PATH`

## About

It is just a 100 lines of PHP & Javascript. The front-end uses Vuejs and Milligram framework. Took me less than 2 hours to write it including this README file :^) 

Made it to scratch my own itch but in case someone finds it useful let me know!

## Credits

All credit goes to Alec Thomas for his wonderful software.