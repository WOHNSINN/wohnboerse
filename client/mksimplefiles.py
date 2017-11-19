#! /usr/bin/env python3

import os
import shutil


def create_simplename(directory, ending):
    for name in os.listdir(directory):
        if name.endswith(ending) and len(name.split('.')) == 3:
            filename = os.path.abspath(os.path.join(directory, name))
            simple_name = os.path.join(directory, 'main' + ending)
            if os.path.exists(simple_name):
                os.remove(simple_name)
            print("copy {} -> {}".format(filename, simple_name))
            shutil.copy2(filename, simple_name)


static_dir = os.path.join('build', 'static')


def main():
    create_simplename(os.path.join(static_dir, 'css'), '.css')
    create_simplename(os.path.join(static_dir, 'js'), '.js')


if __name__ == "__main__":
    main()
