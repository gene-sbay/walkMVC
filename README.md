walkMVC - Clean easy to read PHP MVC stack
=======

This is a PHP MVC stack that is based on two core principles:

A) Build the stack using proven open source frameworks to streamline heavy lifting.  walkMVC is organized around phpDataMapper, Smarty, slimFramework, and jquery.dform‎.  The big advantage here is that when you move to the next project that uses a different framework, there's a good chance you will get to use at least some of the components you worked with here. 

B) Build all components in a "model-centric" way

The majority of the work in any app revolves around the model.  So in this framework, instead of grouping models and controllers separately - controllers are placed in the model folder they are most closely connected with.  Granted this approach may not work for every application, but I think for many it should do the trick.



Design Patterns
----------
This structure uses the following patterns to help make navigating the code as easy as possible:

* define the model data in PHP for both the database and HTML forms

* use a centralized dispatcher with slimPHP
 * Here we have an .htaccess file that allows to take the file abc.php and make the root of the path /abc (without mention of PHP)

* instead of dividing/grouping the code across M-V-C, we group controllers and models in the same model folder

* in each model folder, we use the file name conventions (where Xyz is the model name): 
  * formcfg_Xyz.php - HTML form definition for dForm. Also, use this file for mapping request params to DB model values
  * map_Xyz.php - DB model definition
  * rest_Xyz.php - REST paths to use and the associated helper function.  It handles selecting the view to render
  * [Model controller] - for accessing the database




Example Project1: /webapps/walk_auth 
================================

See the file access.php - it is the main access point for the app.





