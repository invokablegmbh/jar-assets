.. include:: /Includes.rst.txt
.. index:: Example
.. _example:

Example
========

Simple example of including all assets from a folder.

   Example::

	   Example:
		page.31 = COA
		page.31 {
			10 = ASSETS
			10.path = EXT:fileadmin/assets/javaScript/libraries
			10.standalone = 0
			
			20 = ASSETS
			20.path = EXT:fileadmin/assets/css
			20.standalone = 1
		}
