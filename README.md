CRUD-Skeleton-for-Codeigniter
=============================

This skeleton provided me with quick CRUD functionality for several projects. 
The general ideas is to derive most of the logic from the database schema and the correponding model.
The user model, the user controller and the user views are example files.

Installation
-------------
- Copy all files into the *application* folder of your codeigniter installation.  
- Create a new model by extending the *dbRecordModel*. Adjust the parameters according to the structure of your database table.
- Customize the code generation templates in the *code_generation_templates* folder
- Create a controller, include the *codegenerator_helper* and call the *generate_controller()*, *generate_overview()*, *generate_detailview()* functions. Use the name of the model without the suffix "model" as the first and *true* as the second parameter.
                                                                                                                                                For problems and comments please contact me.