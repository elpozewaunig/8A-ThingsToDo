# 6A ThingsToDo

This is the source code for running an Apache Server to provide an overview and help coordinate workload for students of 6A during the Coronavirus break. It features a dynamically generated table tailored to the respective users subjects, the possibility to store progress on the server and also some more goodies, such as a conference calender. For the time being it is specifically tailored to this usecase, but it can easily be customized to more general situations.

## Configuration
The setup requires creating a file named ``password.txt`` in the root directory. This file should only contain the password for letting users log in to the website. This is just one password for the entire class. Users are trusted not to vandalize others progress.

## Data
Create a folder called ``data``. User data, progress and work will be stored there.

### Work
Within the ``data`` folder, create a folder called ``work``. Place a file called ``work.txt`` into this folder.
In it you can note down work using the following structure:

``Subject | ID | Description | Resource | Deadline (DD.MM.YYYY)``

Example: ``M | 1 | First assignment | https://www.example.org | 01.01.1994``

The ID must be a unique number or string and once it is set, it may not be changed, as it is used for storing progress.

### Users
Within the ``data`` folder, create a folder called ``users``. Create files named like the user (without a file extension). Enter the subjects for this user, separated by a comma. You can optionally also enter groups in square brackets.

### Groups (optional)
If desired you can define groups, a collection of subjects, accessible with just their name, so it is not necessary to write dozens of common subjects into the user files.
Within the ``data`` folder, create a folder called ``groups``. Create files named like the group of subjects (without a file extension). Enter the subjects of this group, separated by a comma.

Example:
A group called "base" must be saved under ``data/groups/base``. It can then be referenced in student files using ``[base]``. The group file must then contain subjects separated by commas, e.g. ``M, E, PH``

## Specials (optional)

### Subjects
This data type was designed to enable automatic calculation for the next lesson after the school begins again, since this date was not fixed for a long time at still might be changed.
Within the ``data`` folder, a folder named ``subjects`` can be created. Within it, there should be a file named ``subjects.txt``. Subjects can be entered using the following structure:

Subject | 3-letter-weekdays separated by commas (Mon, Tue, ...)

### Conferences
To add conferences, create a folder called ``conferences`` within the ``data`` folder. Place a file called ``conferences.txt`` into this folder.
In it you can note down upcoming conferences using the following structure:

Subject | Description | Link | Date (DD.MM.YYY, hh:mm)

## Customization

### Default subjects
At ``modules/constants.php`` there is an array containing the default subjects that will be displayed if no user is set. If you want to add or remove subjects, change this file according to the schema found there.

### Subject labels
The CSS at ``stylesheets/subjects.css`` is meant to be fully customized if you create new subjects or are not happy with the default styling.

### Styling
To change basic styling, you should modify ``stylesheets/common.css``. This should fullfil most of your needs. In order to change the default title, class or links, you can simply swap out minor portions of text at ``modules/topbar.php`` and ``modules/bottombar.php``. To change the title tag of the PHP pages, simply exchange the text enclosed in ``<title> ... </title>`` of the respective pages.

## Open Source Licenses
* [TableFilter](https://github.com/koalyptus/TableFilter), a JavaScript library that allows tables to be filtered and sorted, is used in the frontend. It is licensed under the MIT License.
* [FontAwesome](https://fontawesome.com) is the origin of the website icons, all of which are licensed under Creative Commons BY 4.0.
