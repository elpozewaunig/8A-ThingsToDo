# 7A ThingsToDo

This is the source code for running an Apache Server to provide an overview and help coordinate workload for students of class 7A during the Coronavirus break. It features a dynamically generated table tailored to the respective users subjects, the possibility to store progress on the server and also some more goodies, such as a conference calendar. For the time being it is specifically tailored to this usecase, but it can easily be customized to more general situations.

## Installation
Check out [``INSTALL.md``](INSTALL.md) to find out how to install this project.

## Configuration
The setup requires creating a file named ``password.txt`` in the root directory. This file should only contain the password for letting users log in to the website. This is just one password for the entire class. Users are trusted not to vandalize others progress.

## Data
Create a folder called ``data``. User data, progress and work will be stored there.

### .htaccess
It is highly recommended to place a file called ``.htaccess`` in the ``data`` folder. It should have the following content:
```
Order Allow,Deny
Deny from All
```
This prevents people from accessing data without being logged in.

### Work
Within the ``data`` folder, create a folder called ``work``. Place a file called ``work.txt`` into this folder.
In it you can note down work using the following structure:

``Subject | ID | Description | Resource | Deadline (DD.MM.YYYY)``

Example: ``M | 1 | First assignment | https://www.example.org | 01.01.1994``

The ID must be a unique number or string and once it is set, it may not be changed, as it is used for storing progress.
You can write a ``#`` symbol instead of a date. If you have created a ``subjects.txt`` file as described below, the next lesson after school start will be calculated as the deadline.

### Users
Within the ``data`` folder, create a folder called ``users``. Create files named like the user (without a file extension). Enter the subjects for this user, separated by a comma. You can optionally also enter groups in square brackets.

### Groups (optional)
If desired you can define groups, a collection of subjects, accessible with just their name, so it is not necessary to write dozens of common subjects into the user files.
Within the ``data`` folder, create a folder called ``groups``. Create files named like the group of subjects (without a file extension). Enter the subjects of this group, separated by a comma.

Example:
A group called "base" must be saved under ``data/groups/base``. It can then be referenced in student files using ``[base]``. The group file must then contain subjects separated by commas, e.g. ``M, E, PH``

## Specials (optional)

### Subjects
This data type was designed to enable automatic calculation for the next lesson after school begins again, since this date was not fixed for a long time and still might be changed.
Within the ``data`` folder, a folder named ``subjects`` can be created. Within it, there should be a file named ``subjects.txt``. Subjects can be entered using the following structure:

Subject | 3-letter-weekdays separated by commas (Mon, Tue, ...)

To change the school start date, simply change the value of ``school_start`` in [``config.txt``](config.txt). It can be written in American notation using slashes (/) or European notation using dashes (-).

### Conferences
To add conferences, create a folder called ``conferences`` within the ``data`` folder. Place a file called ``conferences.txt`` into this folder.
In it you can note down upcoming conferences using the following structure:

Subject | Description | Link | Start time (DD.MM.YYYY, hh:mm) | Optional: End time (DD.MM.YYYY, hh:mm)

You can omit the end time and the calendar will display it as a one hour block. You can write a ``#`` symbol instead of a date and the end time will be calculated using the default lesson length.

Optionally you can create a file called ``archive.txt``. Past conferences are not automatically hidden by the code, so that rejoining extended video conferences is less of a hassle. Since they need to be removed manually, it can be desired that they still stay visible on the calendar. You can achieve this by pasting past conferences into said ``archive.txt`` file.

## Customization

### Contact & Thanks
The [``about.php``](about.php) and [``thanks.php``](thanks.php) pages are placeholders to get you started. Please change these pages accordingly. You need not mention the original author or license as long as you keep the [``LICENSE``](LICENSE) file in this repository. However, you do need to keep the section "Open Source Licenses" on the About page.

### Default subjects
At [``modules/constants.php``](modules/constants.php) there is an array containing the default subjects that will be displayed if no user is set. If you want to add or remove subjects, change this file according to the schema found there.

### Subject labels
The CSS at [``stylesheets/subjects.css``](stylesheets/subjects.css) is meant to be fully customized if you create new subjects or are not happy with the default styling.

### Styling
To change basic styling, you should modify [``stylesheets/common.css``](stylesheets/common.css). This should fullfil most of your needs.
In order to change the default title, class or icons, you can change the values of the ``key: value`` pairs in [``config.txt``](config.txt).
If you want to change links, you can simply swap out minor portions of text at [``modules/common/topbar.php``](modules/common/topbar.php) and [``modules/bottombar.php``](modules/bottombar.php). To change the title tag of the PHP pages, simply exchange the text enclosed in ``<title> ... </title>`` of the respective pages.

## Open Source Licenses
* [TableFilter](https://github.com/koalyptus/TableFilter), a JavaScript library that allows tables to be filtered and sorted, is used in the frontend. It is licensed under the MIT License.
* [FullCalendar](https://github.com/fullcalendar/fullcalendar), a JavaScript library that renders beautiful, feature-rich calendars, is used in the frontened. It is licensed under the MIT License.
* [FontAwesome](https://fontawesome.com) is the origin of the website icons, all of which are licensed under Creative Commons BY 4.0.
